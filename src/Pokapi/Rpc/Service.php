<?php
namespace Pokapi\Rpc;

use GuzzleHttp\Client;
use POGOProtos\Networking\Envelopes\AuthTicket;
use POGOProtos\Networking\Envelopes\RequestEnvelope;
use POGOProtos\Networking\Envelopes\RequestEnvelope_AuthInfo;
use POGOProtos\Networking\Envelopes\RequestEnvelope_AuthInfo_JWT;
use POGOProtos\Networking\Envelopes\ResponseEnvelope;
use Pokapi\Authentication\Provider;
use Pokapi\Authentication\Token;
use Pokapi\Exception\NoResponse;
use Pokapi\Rpc\Requests\DownloadSettings;
use Pokapi\Rpc\Requests\GetHatchedEggs;
use Pokapi\Rpc\Requests\GetInventory;
use Pokapi\Rpc\Requests\GetPlayer;

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
            ]
        ]);
    }

    /**
     * Execute a request
     *
     * @param Request $request
     * @return null|\ProtobufMessage
     * @throws \Exception
     */
    public function execute(Request $request)
    {
        $envelope = $this->createEnvelope($request);

        $response = $this->httpClient->post($this->endpoint, [
            'body' => $envelope->toProtobuf()
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Wrong statuscode." . $response->getStatusCode());
        }

        $responseEnvelope = new ResponseEnvelope($response->getBody()->getContents());

        if ($responseEnvelope->getAuthTicket()) {
            $this->ticket = $responseEnvelope->getAuthTicket();
        }

        if (!empty($responseEnvelope->getApiUrl())) {
            $this->setEndpoint($responseEnvelope->getApiUrl());
        }

        if ($responseEnvelope->getStatusCode() === 53) {
            return $this->execute($request);
        }

        if (!empty($responseEnvelope->getReturnsArray())) {
            return $request->getResponse(current($responseEnvelope->getReturnsArray()));
        }

        throw new NoResponse();
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
     * @param Request $request
     *
     * @return RequestEnvelope
     */
    protected function createEnvelope(Request $request) : RequestEnvelope
    {
        $envelope = new RequestEnvelope();
        $envelope->setStatusCode(2);
        $envelope->setLatitude($request->getLatitude());
        $envelope->setLongitude($request->getLongitude());
        $envelope->setAltitude($request->getAltitude());
        $envelope->setRequestId($this->getRequestId());
        $envelope->setUnknown12(59);

        // Check if we have an authentication ticket
        if ($this->ticket && $this->ticket->getExpireTimestampMs() > time()) {
            $envelope->setAuthTicket($this->ticket);
        } else {
            if (!$this->token || $this->token->hasExpired()){
                $this->token = $this->authentication->getToken();
            }
            $authInfo = new RequestEnvelope_AuthInfo();
            $authInfo->setProvider($this->authentication->getType());
            $authToken = new RequestEnvelope_AuthInfo_JWT();
            $authToken->setContents($this->token->getToken());
            $authToken->setUnknown2(59);
            $authInfo->setToken($authToken);
            $envelope->setAuthInfo($authInfo);
        }

        $envelope->addAllRequests([$request->toProtobufRequest()]);
        return $envelope;
    }
}
