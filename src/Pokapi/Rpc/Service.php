<?php
namespace Pokapi\Rpc;

use GuzzleHttp\Client;
use POGOEncrypt\Encrypt;
use POGOProtos\Networking\Envelopes\RequestEnvelope;
use POGOProtos\Networking\Envelopes\ResponseEnvelope;
use POGOProtos\Networking\Envelopes\Signature;
use POGOProtos\Networking\Envelopes\Unknown6;
use POGOProtos\Networking\Platform\PlatformRequestType;
use POGOProtos\Networking\Platform\Requests\SendEncryptedSignatureRequest;
use Pokapi\Authentication\Provider;
use Pokapi\Authentication\Token;
use Pokapi\Exception\NoResponse;
use Pokapi\Exception\RequestException;
use Pokapi\Exception\ThrottledException;
use Pokapi\Request\DeviceInfo;
use Pokapi\Request\Position;
use Pokapi\Utility\Signature as SignatureUtil;
use Protobuf\AbstractMessage;

/**
 * Class Service
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
class Service
{

    /**
     * @var AuthTicket|null
     */
    protected $ticket;

    /**
     * @var string
     */
    protected $endpoint = 'https://pgorelease.nianticlabs.com/plfe/rpc';

    /**
     * @var Provider
     */
    protected $authentication;

    /**
     * @var DeviceInfo
     */
    protected $deviceInfo;

    /**
     * @var int
     */
    protected $requestId;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var Token
     */
    protected $token;

    /**
     * @var int
     */
    protected $startTime = 0;

    /**
     * @var int
     */
    protected $lastRequestMs;

    /**
     * @var string
     */
    protected $sessionHash;

    /**
     * @var int
     */
    protected $retryCount;

    /**
     * @var ResponseEnvelope
     */
    protected $lastResponse;

    /**
     * Service constructor.
     *
     * @param Provider $authenticationProvider
     * @param DeviceInfo $deviceInfo
     * @param int $throttleRetryCount
     */
    public function __construct(Provider $authenticationProvider, DeviceInfo $deviceInfo, $throttleRetryCount = 2)
    {
        $this->authentication = $authenticationProvider;
        $this->deviceInfo = $deviceInfo;
        $this->requestId = mt_rand();
        $this->httpClient = new Client([
            'headers' => [
                'User-Agent' => 'Niantic App'
            ],
            'connect_timeout' => 30,
            'verify' => false,
        ]);

        $this->retryCount = $throttleRetryCount;
        $this->startTime = round(microtime(true) * 1000);
    }

    /**
     * Get the last request timestamp in milliseconds
     *
     * @return int
     */
    public function getLastRequestTimestamp()
    {
        return $this->lastRequestMs;
    }

    /**
     * Execute multiple requests
     *
     * @param array $requests
     * @param Position $position
     * @param int $attempt
     *
     * @return \Protobuf\Collection
     *
     * @throws NoResponse
     * @throws \Exception
     */
    public function batchExecute(array $requests, Position $position, $attempt = 0)
    {
        $this->lastRequestMs = round(microtime(true) * 1000);

        $envelope = $this->createEnvelope($requests, $position);

        $contents = $envelope->toStream()->getContents();
        try {
            $response = $this->httpClient->post($this->endpoint, [
                'body' => $contents
            ]);
        } catch(\Exception $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Wrong statuscode: " . $response->getStatusCode());
        }

        if (!$response->getBody()->isReadable()) {
            throw new NoResponse("Unreadable stream.");
        }

        if ($response->getBody()->getSize() < 1) {
            throw new NoResponse("Empty body.");
        }

        $responseEnvelope = new ResponseEnvelope($response->getBody()->getContents());
        $this->lastResponse = $responseEnvelope;

        if ($responseEnvelope->getAuthTicket()) {
            $this->ticket = AuthTicket::fromProto($responseEnvelope->getAuthTicket());
        }

        if (!empty($responseEnvelope->getApiUrl())) {
            $this->setEndpoint($responseEnvelope->getApiUrl());
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::REDIRECT()) {
            return $this->batchExecute($requests, $position);
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::INVALID_PLATFORM_REQUEST()) {
            $attempt++;
            if ($attempt >= $this->retryCount) {
                throw new ThrottledException();
            }
            sleep(1);
            return $this->batchExecute($requests, $position, $attempt);
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::INVALID_AUTH_TOKEN()) {
            $this->token = null;
            $this->ticket = null;
            return $this->batchExecute($requests, $position);
        }

        if (!empty($responseEnvelope->getReturnsList())) {
            return $responseEnvelope->getReturnsList();
        }

        throw new NoResponse("No return messages in response.");
    }

    /**
     * Get the last response
     *
     * @return ResponseEnvelope
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * Execute a request
     *
     * @param Request $request
     * @param Position $position
     *
     * @return null|AbstractMessage
     * @throws \Exception
     */
    public function execute(Request $request, Position $position)
    {
        $response = $this->batchExecute([$request], $position);
        return $request->getResponse(current($response));
    }

    /**
     * Set the endpoint to use
     *
     * @param string $endpoint
     */
    protected function setEndpoint(string $endpoint)
    {
        $fullEndpoint = 'https://' . $endpoint . '/rpc';

        if (!empty($endpoint) && $fullEndpoint !== $this->endpoint) {
            $this->endpoint = $fullEndpoint;
        }
    }

    /**
     * Get the next request id
     *
     * @return int
     */
    protected function getRequestId() : int
    {
        return $this->requestId++;
    }

    /**
     * Create a request envelope
     *
     * @param Request[] $requests
     * @param Position $position
     *
     * @return RequestEnvelope
     */
    protected function createEnvelope(array $requests, Position $position) : RequestEnvelope
    {
        $envelope = new RequestEnvelope();
        $envelope->setStatusCode(2);
        $envelope->setLatitude($position->getLatitude());
        $envelope->setLongitude($position->getLongitude());
        $envelope->setAccuracy($position->getAccuracy());
        $envelope->setRequestId($this->getRequestId());
        $envelope->setMsSinceLastLocationfix(mt_rand(700, 1200));

        // Check if we have an authentication ticket
        if ($this->ticket && !$this->ticket->hasExpired()) {
            $envelope->setAuthTicket($this->ticket->toProto());
        } else {
            if (!$this->token || $this->token->hasExpired()){
                $this->token = $this->authentication->getToken();
            }
            $authInfo = new RequestEnvelope\AuthInfo();
            $authInfo->setProvider($this->authentication->getType());
            $authToken = new RequestEnvelope\AuthInfo\JWT();
            $authToken->setContents($this->token->getToken());
            $authToken->setUnknown2(59);
            $authInfo->setToken($authToken);
            $envelope->setAuthInfo($authInfo);
        }

        foreach ($requests as $request) {
            $envelope->addRequests($request->toProtobufRequest());
        }

        if ($this->ticket && !$this->ticket->hasExpired()) {
            // Add an encrypted signature platform request to the envelope.
            $platformRequest = new RequestEnvelope\PlatformRequest();
            $platformRequest->setType(PlatformRequestType::SEND_ENCRYPTED_SIGNATURE());

            $encryptedSigRequest = new SendEncryptedSignatureRequest();
            $encryptedSigRequest->setEncryptedSignature($this->generateSignature($requests, $position));

            $platformRequest->setRequestMessage($encryptedSigRequest->toStream());

            $envelope->addPlatformRequests($platformRequest);
            $envelope->setMsSinceLastLocationfix(rand(3000, 9000));
        }

        return $envelope;
    }

    /**
     * Generate the signature
     *
     * @param Request[] $requests
     * @param Position $position
     *
     * @return string
     */
    protected function generateSignature(array $requests, Position $position) : string
    {
        $serializedTicket = $this->ticket->toProto()->toStream()->getContents();

        $signature = new Signature();
        $signature->setLocationHash1(
            SignatureUtil::generateLocation1(
                $serializedTicket,
                $position->getLatitude(),
                $position->getLongitude(),
                $position->getAccuracy()
            )
        );

        $signature->setLocationHash2(
            SignatureUtil::generateLocation2(
                $position->getLatitude(),
                $position->getLongitude(),
                $position->getAccuracy()
            )
        );

        foreach ($requests as $request) {
            $signature->addRequestHash(
                SignatureUtil::generateRequestHash(
                    $serializedTicket,
                    $request->toProtobufRequest()->toStream()->getContents()
                )
            );
        }

        $time = round(microtime(true) * 1000);
        $signature->setSessionHash($this->getSessionHash());
        $signature->setTimestamp($time);
        $signature->setTimestampSinceStart($time - $this->startTime);
        $signature->setUnknown25(0x898654dd2753a481);

        $signature->setDeviceInfo($this->deviceInfo->toProtobuf());

        foreach ($this->generateLocationFixes($position) as $fix) {
            $signature->addLocationFix($fix);
        }

        $signature->setSensorInfo($this->generateSensorInfo());

        return Encrypt::encrypt($signature->toStream()->getContents(), random_bytes(32));
    }

    /**
     * Get the session hash
     *
     * @return string
     */
    protected function getSessionHash()
    {
        if ($this->sessionHash === null) {
            $this->sessionHash = random_bytes(32);
        }

        return $this->sessionHash;
    }

    /**
     * Generate a list of location fixes
     *
     * @param Position $position
     *
     * @return Signature\LocationFix[]
     */
    protected function generateLocationFixes(Position $position) : array
    {
        $amount = rand(3,5);
        $fixes = [];

        for($i = 0; $i < $amount; $i++) {
            $fixes[] = $this->generateLocationFix($position);
        }

        return $fixes;
    }

    /**
     * Generate a location fix
     *
     * @param Position $position
     *
     * @return Signature\LocationFix
     */
    protected function generateLocationFix(Position $position) : Signature\LocationFix
    {
        $location = $position->createRandomized();

        $locationFix = new Signature\LocationFix();
        $locationFix->setProvider("network");
        $locationFix->setProviderStatus(3);
        $locationFix->setLocationType(1);
        $locationFix->setTimestampSnapshot(rand(10000,35000));
        $locationFix->setAltitude($location->getAltitude());
        $locationFix->setLongitude($location->getLongitude());
        $locationFix->setLatitude($location->getAltitude());

        return $locationFix;
    }

    /**
     * Generate sensor information
     *
     * @return Signature\SensorInfo
     */
    protected function generateSensorInfo() : Signature\SensorInfo
    {
        $sensorData = Sensors::createRandom(3);

        /* Fetch data */
        $rawAccell = $sensorData->getAccelerometerData();
        $normAccell = $sensorData->getNormalizedAccelerometerData();
        $angle = $sensorData->getAngleData();
        $gyro = $sensorData->getGyroscopeData();
        $magneto = $sensorData->getMagnetoData();

        $sensorInfo = new Signature\SensorInfo();
        $sensorInfo->setTimestampSnapshot(rand(1000,3500));
        $sensorInfo->setAccelerometerAxes(3);

        /* MOTION SENSORS */
        /* Rotation Vector */
        $sensorInfo->setRotationVectorX($angle[0]);
        $sensorInfo->setRotationVectorY($angle[1]);
        $sensorInfo->setRotationVectorZ($angle[2]);

        /* Linear Acceleration (this excludes gravity) */
        $sensorInfo->setLinearAccelerationX($normAccell[0]);
        $sensorInfo->setLinearAccelerationY($normAccell[1]);
        $sensorInfo->setLinearAccelerationZ($normAccell[2]);

        /* Gravity */
        /* Note from Google Sensor documentation: When a device is at rest, the output of the gravity sensor should
           be identical to that of the accelerometer. */
        $sensorInfo->setGravityX($rawAccell[0]);
        $sensorInfo->setGravityY($rawAccell[1]);
        $sensorInfo->setGravityZ($rawAccell[2]);

        /* Gyroscope */
        $sensorInfo->setGyroscopeRawX($gyro[0]);
        $sensorInfo->setGyroscopeRawY($gyro[1]);
        $sensorInfo->setGyroscopeRawZ($gyro[2]);

        /* POSITION SENSORS */
        /* Magnetic field */
        $sensorInfo->setMagneticFieldX($magneto[0]);
        $sensorInfo->setMagneticFieldY($magneto[1]);
        $sensorInfo->setMagneticFieldZ($magneto[2]);

        return $sensorInfo;
    }
}
