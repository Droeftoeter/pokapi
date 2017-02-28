<?php
namespace Pokapi\Rpc;

use Exception;
use GuzzleHttp\Client;
use POGOEncrypt\Encrypt;
use POGOProtos\Networking\Envelopes\RequestEnvelope;
use POGOProtos\Networking\Envelopes\ResponseEnvelope;
use POGOProtos\Networking\Envelopes\Signature;
use POGOProtos\Networking\Platform\PlatformRequestType;
use POGOProtos\Networking\Platform\Requests\SendEncryptedSignatureRequest;
use POGOProtos\Networking\Responses\CheckChallengeResponse;
use POGOProtos\Networking\Responses\VerifyChallengeResponse;
use Pokapi\Authentication;
use Pokapi\Captcha\Solver;
use Pokapi\Exception\FailedCaptchaException;
use Pokapi\Exception\FlaggedAccountException;
use Pokapi\Hashing;
use Pokapi\Exception\NoResponse;
use Pokapi\Exception\RequestException;
use Pokapi\Exception\ThrottledException;
use Pokapi\Request\DeviceInfo;
use Pokapi\Request\Position;
use Pokapi\Rpc\Requests\CheckChallenge;
use Pokapi\Rpc\Requests\GetMapObjects;
use Pokapi\Rpc\Requests\GetPlayer;
use Pokapi\Rpc\Requests\VerifyChallenge;
use Pokapi\Version\Version;
use Protobuf\AbstractMessage;
use Protobuf\MessageCollection;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

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
     * @var Authentication\Provider
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
     * @var Authentication\Token
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
     * @var Hashing\Provider
     */
    protected $hashingProvider;

    /**
     * @var Version
     */
    protected $version;

    /**
     * @var ResponseEnvelope
     */
    protected $lastResponse;

    /**
     * @var Position
     */
    protected $lastPosition;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Solver
     */
    protected $captchaResolver;

    /**
     * @var int
     */
    protected $rsc;

    /**
     * @var int
     */
    protected $rscThreshold;

    /**
     * Service constructor.
     *
     * @param Version                 $version
     * @param Authentication\Provider $authenticationProvider
     * @param DeviceInfo              $deviceInfo
     * @param Hashing\Provider|null   $hashingProvider
     * @param int                     $throttleRetryCount
     * @param Solver|null             $captchaSolver
     * @param LoggerInterface|null    $logger
     */
    public function __construct(
        Version $version,
        Authentication\Provider $authenticationProvider,
        DeviceInfo $deviceInfo,
        Hashing\Provider $hashingProvider = null,
        int $throttleRetryCount = 2,
        Solver $captchaSolver = null,
        LoggerInterface $logger = null
    ) {
        $this->version        = $version;
        $this->authentication = $authenticationProvider;
        $this->deviceInfo     = $deviceInfo;
        $this->requestId      = mt_rand();
        $this->httpClient     = new Client([
            'headers' => [
                'User-Agent' => 'Niantic App'
            ],
            'connect_timeout' => 30,
            'verify' => false,
        ]);

        $this->retryCount   = $throttleRetryCount;
        $this->rsc          = 0;
        $this->rscThreshold = 12;
        $this->startTime    = round(microtime(true) * 1000);

        $this->hashingProvider = $hashingProvider !== null ? $hashingProvider : new Hashing\Native();
        $this->captchaResolver = $captchaSolver;
        $this->logger          = $logger !== null ? $logger : new NullLogger();
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
     * @throws Exception
     */
    public function batchExecute(array $requests, Position $position, $attempt = 0)
    {
        /* CAPTCHA first? */
        $this->rsc++;
        if ($this->rsc > $this->rscThreshold) {
            if ($this->captchaResolver instanceof Solver) {
                $this->checkChallenge($position);
            }
        }

        $this->lastRequestMs = round(microtime(true) * 1000);
        $this->lastPosition  = $position;

        $envelope = $this->createEnvelope($requests, $position);
        $contents = $envelope->toStream()->getContents();

        try {
            $response = $this->httpClient->post($this->endpoint, [
                'body' => $contents
            ]);
        } catch(Exception $e) {
            throw new RequestException($e->getMessage(), $e->getCode(), $e);
        }

        $this->logger->debug("Received HTTP Status {StatusCode}", array('StatusCode' => $response->getStatusCode()));

        if ($response->getStatusCode() !== 200) {
            throw new Exception("Wrong statuscode: " . $response->getStatusCode());
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
            $this->logger->debug("Received AuthTicket");
            $this->ticket = AuthTicket::fromProto($responseEnvelope->getAuthTicket());
        }

        if (!empty($responseEnvelope->getApiUrl())) {
            $this->logger->debug("Received new API Endpoint {URL}", array('URL' => $responseEnvelope->getApiUrl()));
            $this->setEndpoint($responseEnvelope->getApiUrl());
            $this->rsc = $this->rscThreshold; // Always CAPTCHA on new URI for next request.
        }

        $this->logger->debug(
            "Received ResponseEnvelope with StatusCode {StatusCode}",
            array(
                'StatusCode' => $responseEnvelope->getStatusCode()->name()
            )
        );

        if (
            $responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::REDIRECT()
        ) {
            return $this->batchExecute($requests, $position);
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::BAD_REQUEST()) {
            throw new RequestException(
                "Received BAD_REQUEST from API: " . $responseEnvelope->getError(),
                $responseEnvelope->getStatusCode()->value()
            );
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::SESSION_INVALIDATED()) {
            $attempt++;
            if ($attempt >= $this->retryCount) {
                throw new ThrottledException();
            }
            sleep(2);
            return $this->batchExecute($requests, $position, $attempt);
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::INVALID_PLATFORM_REQUEST()) {
            $attempt++;
            if ($attempt >= $this->retryCount) {
                throw new ThrottledException();
            }
            sleep(2);
            return $this->batchExecute($requests, $position, $attempt);
        }

        if ($responseEnvelope->getStatusCode() === ResponseEnvelope\StatusCode::INVALID_AUTH_TOKEN()) {
            $this->token = null;
            $this->ticket = null;
            return $this->batchExecute($requests, $position);
        }

        if (!empty($responseEnvelope->getReturnsList())) {
            $this->retryCount = 0;
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
     * @throws Exception
     */
    public function execute(Request $request, Position $position)
    {
        $response = $this->batchExecute([$request], $position);
        return $request->getResponse(current($response));
    }

    /**
     * Check if there is a CAPTCHA challenge
     *
     * Throws if there is a challenge but no defined resolver.
     * Returns false if there is no challenge.
     *
     * Will attempt to solve the CAPTCHA automatically
     *
     * @param Position $position
     *
     * @return bool
     *
     * @throws FailedCaptchaException
     * @throws FlaggedAccountException
     */
    public function checkChallenge(Position $position)
    {
        $this->rsc = 0;

        $request = new CheckChallenge();

        /** @var CheckChallengeResponse $response */
        $response     = $this->execute($request, $position->createRandomized());
        $challengeUrl = trim($response->getChallengeUrl());

        if ($response->getShowChallenge() || !empty($challengeUrl)) {
            if (!$this->captchaResolver instanceof Solver) {
                $this->logger->alert("Account has been flagged for CAPTCHA. No CAPTCHA resolver defined.");
                throw new FlaggedAccountException($challengeUrl);
            }

            $this->logger->alert("Account has been flagged for CAPTCHA. Attempting to solve CAPTCHA with defined resolver.");

            /* Attempt to solve CAPTCHA */
            $token = $this->captchaResolver->solve($challengeUrl);
            $this->logger->info("Received CAPTCHA solution. Verifying...");

            /* Wait before firing verification */
            sleep(2);
            $verification = new VerifyChallenge($token);

            /** @var VerifyChallengeResponse $response */
            $response = $this->execute($verification, $position->createRandomized());

            if ($response->hasSuccess()) {
                $this->logger->info("Successfully solved CAPTCHA.");
                sleep(2);
                return true;
            }

            throw new FailedCaptchaException("Failed to resolve CAPTCHA. Request a new challenge to retry.");
        }

        sleep(2);
        $this->logger->debug("Hooray! Account is not flagged for CAPTCHA.");
        return false;
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
        $authInfo = null;

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

        // Attach the UNKNOWN_PTR_8 request if version is > 4500 and there is a GET_MAP_OBJECTS or GET_PLAYER request
        $platform8Requests = array_filter(
            $requests,
            function (Request $request) {
                return $request instanceof GetMapObjects || $request instanceof GetPlayer;
            }
        );

        if ($this->version->getVersion() > 4500 && count($platform8Requests) > 0) {
            $platform8Request = new RequestEnvelope\PlatformRequest();
            $platform8Request->setType(PlatformRequestType::UNKNOWN_PTR_8());
            $platform8Request->setRequestMessage($this->version->getPlatform8());
        }

        // Add an encrypted signature platform request to the envelope.
        $platformRequest = new RequestEnvelope\PlatformRequest();
        $platformRequest->setType(PlatformRequestType::SEND_ENCRYPTED_SIGNATURE());

        $encryptedSigRequest = new SendEncryptedSignatureRequest();
        $encryptedSigRequest->setEncryptedSignature(
            $this->generateSignature($requests, $position, $authInfo)
        );

        $platformRequest->setRequestMessage($encryptedSigRequest->toStream());
        $envelope->addPlatformRequests($platformRequest);

        $envelope->setMsSinceLastLocationfix(rand(200, 800));

        return $envelope;
    }

    /**
     * Generate the signature
     *
     * @param Request[]                     $requests
     * @param Position                      $position
     * @param RequestEnvelope\AuthInfo|null $authInfo
     *
     * @return string
     */
    protected function generateSignature(array $requests, Position $position, RequestEnvelope\AuthInfo $authInfo = null) : string
    {

        $authData = $this->ticket instanceof AuthTicket && !$this->ticket->hasExpired() ?
            Hashing\AuthData::withAuthTicket($this->ticket) :
            Hashing\AuthData::withAuthInfo($authInfo);

        $time    = round(microtime(true) * 1000);
        $request = new Hashing\Request(
            $this->version,
            $authData,
            $position,
            $time,
            $this->getSessionHash(),
            $requests
        );

        $response = $this->hashingProvider->calculate($request);

        $signature = new Signature();
        $signature->setLocationHash1($response->getLocationAuthHash());
        $signature->setLocationHash2($response->getLocationHash());

        foreach ($response->getRequestHashes() as $requestHash) {
            $signature->addRequestHash($requestHash);
        }

        $signature->setSessionHash($this->getSessionHash());
        $signature->setTimestamp($time);
        $signature->setTimestampSinceStart($time - $this->startTime);
        $signature->setUnknown25($this->version->getUnknown25());

        $signature->setDeviceInfo($this->deviceInfo->toProtobuf());

        foreach ($this->generateLocationFixes($position) as $fix) {
            $signature->addLocationFix($fix);
        }

        $signature->setSensorInfoList($this->generateSensorInfo());

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
     * @return MessageCollection
     */
    protected function generateSensorInfo() : MessageCollection
    {
        $list       = new MessageCollection();
        $sensorData = Sensors::createRandom(3);

        /* Fetch data */
        $rawAccell = $sensorData->getAccelerometerData();
        $normAccell = $sensorData->getNormalizedAccelerometerData();
        $angle = $sensorData->getAngleData();
        $gyro = $sensorData->getGyroscopeData();
        $magneto = $sensorData->getMagnetoData();

        $sensorInfo = new Signature\SensorInfo();
        $sensorInfo->setTimestampSnapshot(rand(1000,3500));
        //$sensorInfo->setAccelerometerAxes(3);

        /* MOTION SENSORS */
        /* Rotation Vector */
        /*$sensorInfo->setRotationVectorX($angle[0]);
        $sensorInfo->setRotationVectorY($angle[1]);
        $sensorInfo->setRotationVectorZ($angle[2]);*/

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
        /*$sensorInfo->setGyroscopeRawX($gyro[0]);
        $sensorInfo->setGyroscopeRawY($gyro[1]);
        $sensorInfo->setGyroscopeRawZ($gyro[2]);*/

        /* POSITION SENSORS */
        /* Magnetic field */
        $sensorInfo->setMagneticFieldX($magneto[0]);
        $sensorInfo->setMagneticFieldY($magneto[1]);
        $sensorInfo->setMagneticFieldZ($magneto[2]);

        $list->add($sensorInfo);

        return $list;
    }
}
