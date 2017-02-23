<?php
namespace Pokapi\Hashing;

use Pokapi\Request\Position;
use Pokapi\Version\Version;
use Pokapi\Rpc\Request as RpcRequest;

class Request
{

    /**
     * @var Version
     */
    protected $version;

    /**
     * @var AuthData
     */
    protected $authData;

    /**
     * @var Position
     */
    protected $position;

    /**
     * @var int
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $sessionHash;

    /**
     * @var RpcRequest[]
     */
    protected $requests = [];

    /**
     * Request constructor.
     *
     * @param Version       $version
     * @param AuthData      $authData
     * @param Position      $position
     * @param int           $timestamp
     * @param string        $sessionHash
     * @param RpcRequest[]  $requests
     */
    public function __construct(
        Version $version,
        AuthData $authData,
        Position $position,
        int $timestamp,
        string $sessionHash,
        array $requests
    ) {
        $this->version     = $version;
        $this->authData    = $authData;
        $this->position    = $position;
        $this->timestamp   = $timestamp;
        $this->sessionHash = $sessionHash;
        $this->requests    = $requests;
    }

    /**
     * @return Version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return AuthData
     */
    public function getAuthData()
    {
        return $this->authData;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getSessionHash(): string
    {
        return $this->sessionHash;
    }

    /**
     * @return RpcRequest[]
     */
    public function getRequests(): array
    {
        return $this->requests;
    }
}
