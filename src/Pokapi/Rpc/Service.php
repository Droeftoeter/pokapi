<?php
namespace Pokapi\Rpc;

use GuzzleHttp\Client;
use POGOEncrypt\Encrypt;
use POGOProtos\Networking\Envelopes\RequestEnvelope;
use POGOProtos\Networking\Envelopes\ResponseEnvelope;
use POGOProtos\Networking\Envelopes\Signature;
use POGOProtos\Networking\Envelopes\Unknown6;
use Pokapi\Authentication\Provider;
use Pokapi\Authentication\Token;
use Pokapi\Exception\NoResponse;
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
     * Service constructor.
     *
     * @param Provider $authenticationProvider
     */
    public function __construct(Provider $authenticationProvider)
    {
        $this->authentication = $authenticationProvider;
        $this->requestId = mt_rand();
        $this->httpClient = new Client([
            'headers' => [
                'User-Agent' => 'Niantic App'
            ],
            'connect_timeout' => 30,
        ]);

        $this->startTime = round(microtime() * 1000);
    }

    /**
     * Execute multiple requests
     *
     * @param array $requests
     * @param Position $position
     *
     * @return \Protobuf\Collection
     *
     * @throws NoResponse
     * @throws \Exception
     */
    public function batchExecute(array $requests, Position $position)
    {
        $envelope = $this->createEnvelope($requests, $position);

        $contents = $envelope->toStream()->getContents();
        try {
            $response = $this->httpClient->post($this->endpoint, [
                'body' => $contents
            ]);
        } catch(\Exception $e) {
            throw new NoResponse();
        }

        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Wrong statuscode." . $response->getStatusCode());
        }

        if ($response->getBody()->getSize() === 0) {
            throw new NoResponse();
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

        if ($responseEnvelope->getStatusCode() === 102) {
            $this->token = null;
            $this->ticket = null;
            return $this->batchExecute($requests, $position);
        }

        if (!empty($responseEnvelope->getReturnsList())) {
            return $responseEnvelope->getReturnsList();
        }

        throw new NoResponse();
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

        return Encrypt::encrypt($signature->toStream()->getContents(), random_bytes(32));
    }
}
