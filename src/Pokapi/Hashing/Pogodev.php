<?php
namespace Pokapi\Hashing;

use GuzzleHttp\Client;
use Exception;
use Pokapi\Hashing\Exception\InvalidResponseException;
use Pokapi\Hashing\Exception\UnsupportedVersionException;
use Pokapi\Rpc\Request as RpcRequest;
use Pokapi\Version\Version;

/**
 * Hashing server request hasher, specifically the Pogodev one.
 *
 * @package Pokapi\Hashing
 */
class Pogodev implements Provider {

    /**
     * The host
     */
    const HOST = "http://hashing.pogodev.io";

    /**
     * Version URI
     */
    const VERSION_URL = "/api/hash/versions";

    /**
     * @var string
     */
    protected $key;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string[]
     */
    protected $versionUrls = [];

    /**
     * Pogodev constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->key = $apiKey;
    }

    /**
     * Check if provider supports a specific version of the game.
     *
     * @param Version $version
     *
     * @return bool
     *
     * @throws InvalidResponseException
     */
    public function supportsVersion(Version $version) : bool
    {
        try {
            $this->getVersionUrl($version);
        } catch (UnsupportedVersionException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @throws UnsupportedVersionException
     * @throws InvalidResponseException
     */
    public function calculate(Request $request) : Response
    {
        $url = $this->getVersionUrl($request->getVersion());

        try {
            $response = $this->getClient()->post(
                static::HOST . '/' . $url,
                array(
                    'body'    => json_encode($this->createRequestBody($request)),
                    'headers' => array(
                        'X-AuthToken'  => $this->key,
                        'Content-Type' => 'application/json'
                    )
                )
            );
        } catch (Exception $e) {
            throw new InvalidResponseException($e->getMessage(), $e->getCode(), $e);
        }

        $json = json_decode($response->getBody(), true);

        if (!is_array($json)) {
            throw new InvalidResponseException("Received invalid JSON.");
        }

        return new Response(
            $json['locationAuthHash'],
            $json['locationHash'],
            $json['requestHashes']
        );
    }

    /**
     * Create body
     *
     * @param Request $request
     *
     * @return array
     */
    protected function createRequestBody(Request $request) : array
    {
        $requests = array_map(
            function(RpcRequest $request) {
                return base64_encode($request->toProtobufRequest()->toStream()->getContents());
            },
            $request->getRequests()
        );

        return array(
            'Timestamp'   => $request->getTimestamp(),
            'Latitude'    =>  $request->getPosition()->getLatitude(),
            'Longitude'   => $request->getPosition()->getLongitude(),
            'Altitude'    => $request->getPosition()->getAltitude(),
            'AuthTicket'  => base64_encode($request->getAuthData()->getData()),
            'SessionData' => base64_encode($request->getSessionHash()),
            'Requests'    => $requests
        );
    }

    /**
     * @param Version $version
     *
     * @return string
     *
     * @throws UnsupportedVersionException
     */
    protected function getVersionUrl(Version $version) : string
    {
        if (count($this->versionUrls) === 0) {
            $this->fetchSupportedVersions();
        }

        if (!array_key_exists($version->getAndroidVersion(), $this->versionUrls)) {
            throw new UnsupportedVersionException($version);
        }

        return $this->versionUrls[$version->getAndroidVersion()];
    }

    /**
     * @throws InvalidResponseException
     */
    protected function fetchSupportedVersions()
    {
        try {
            $response = $this->getClient()->get(static::HOST . static::VERSION_URL);
            $versions = json_decode($response->getBody(), true);
        } catch (Exception $e) {
            throw new InvalidResponseException($e->getMessage(), 0, $e);
        }

        if (empty($versions)) {
            throw new InvalidResponseException("Received empty JSON.");
        }

        $this->versionUrls = $versions;
    }

    /**
     * @return Client
     */
    protected function getClient() : Client
    {
        if (!$this->client instanceof Client) {
            $this->client = new Client([
                'headers' => [
                    'User-Agent' => 'PHP-Pokapi'
                ],
                'connect_timeout' => 30,
                'verify' => false
            ]);
        }

        return $this->client;
    }
}
