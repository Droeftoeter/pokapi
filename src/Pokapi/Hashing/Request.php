<?php
namespace Pokapi\Hashing;

use Pokapi\Request\Position;
use Pokapi\Rpc\AuthTicket;
use Pokapi\Rpc\Request as RpcRequest;
use Pokapi\Version\Version;

class Request
{

    /**
     * @var Version
     */
    protected $version;

    /**
     * @var AuthTicket
     */
    protected $authTicket;

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
     * @param Version      $version
     * @param AuthTicket   $authTicket
     * @param Position     $position
     * @param int          $timestamp
     * @param string       $sessionHash
     * @param RpcRequest[] $requests
     */
    public function __construct(
        Version $version,
        AuthTicket $authTicket,
        Position $position,
        int $timestamp,
        string $sessionHash,
        array $requests
    ) {
        $this->version     = $version;
        $this->authTicket  = $authTicket;
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
     * @return AuthTicket
     */
    public function getAuthTicket(): AuthTicket
    {
        return $this->authTicket;
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
