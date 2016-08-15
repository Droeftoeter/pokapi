<?php
namespace Pokapi\Rpc;

use google\protobuf\SourceCodeInfo\Location;
use GuzzleHttp\Client;
use POGOEncrypt\Encrypt;
use POGOProtos\Networking\Envelopes\RequestEnvelope;
use POGOProtos\Networking\Envelopes\ResponseEnvelope;
use POGOProtos\Networking\Envelopes\Signature;
use POGOProtos\Networking\Envelopes\Unknown6;
use Pokapi\Authentication\Provider;
use Pokapi\Authentication\Token;
use Pokapi\Exception\NoResponse;
use Pokapi\Exception\RequestException;
use Pokapi\Exception\ThrottledException;
use Pokapi\Rpc\AuthTicket;
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
    protected $retryCount;

    /**
     * Service constructor.
     *
     * @param Provider $authenticationProvider
     * @param int $throttleRetryCount
     */
    public function __construct(Provider $authenticationProvider, $throttleRetryCount = 2)
    {
        $this->authentication = $authenticationProvider;
        $this->requestId = mt_rand();
        $this->httpClient = new Client([
            'headers' => [
                'User-Agent' => 'Niantic App'
            ],
            'connect_timeout' => 30,
            'verify' => false,
        ]);

        $this->retryCount = $throttleRetryCount;
        $this->startTime = round(microtime() * 1000);
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

        if ($responseEnvelope->getAuthTicket()) {
            $this->ticket = AuthTicket::fromProto($responseEnvelope->getAuthTicket());
        }

        if (!empty($responseEnvelope->getApiUrl())) {
            $this->setEndpoint($responseEnvelope->getApiUrl());
        }

        if ($responseEnvelope->getStatusCode() === 53) {
            return $this->batchExecute($requests, $position);
        }

        if ($responseEnvelope->getStatusCode() === 52) {
            $attempt++;
            if ($attempt >= $this->retryCount) {
                throw new ThrottledException();
            }
            sleep(1);
            return $this->batchExecute($requests, $position, $attempt);
        }

        if ($responseEnvelope->getStatusCode() === 102) {
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
        $envelope->setAltitude($position->getAltitude());
        $envelope->setRequestId($this->getRequestId());
        $envelope->setUnknown12(989);

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
            $unknown6 = new Unknown6();
            $unknown6->setRequestType(6);

            $unknown2 = new Unknown6\Unknown2();
            $unknown2->setEncryptedSignature($this->generateSignature($requests, $position));
            $unknown6->setUnknown2($unknown2);
            $envelope->setUnknown6($unknown6);
            $envelope->setUnknown12(rand(3000, 9000));
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
                $position->getAltitude()
            )
        );

        $signature->setLocationHash2(
            SignatureUtil::generateLocation2(
                $position->getLatitude(),
                $position->getLongitude(),
                $position->getAltitude()
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
        $signature->setSessionHash(random_bytes(32));
        $signature->setTimestamp($time);
        $signature->setTimestampSinceStart($time - $this->startTime);
        $signature->setUnknown25(0x898654dd2753a481);

        $deviceInfo = new Signature\DeviceInfo();
        $deviceInfo->setFirmwareType("9.3.2");
        $deviceInfo->setDeviceModelBoot("iPhone5,1");
        $deviceInfo->setDeviceModel("ïPhone");
        $deviceInfo->setHardwareModel("N41AP");
        $deviceInfo->setFirmwareBrand("iPhone OS");
        $deviceInfo->setDeviceBrand("Apple");
        $deviceInfo->setHardwareManufacturer("Apple");
        $signature->setDeviceInfo($deviceInfo);
        $signature->addLocationFix($this->generateLocationFixes($position));

        return Encrypt::encrypt($signature->toStream()->getContents(), random_bytes(32));
    }

    /**
     * Generate a list of location fixes
     *
     * @param Position $position
     *
     * @return Signature\LocationFix[]
     */
    protected function generateLocationFixes(Position $position)
    {
        $amount = rand(1,4);
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
    protected function generateLocationFix(Position $position)
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
}
