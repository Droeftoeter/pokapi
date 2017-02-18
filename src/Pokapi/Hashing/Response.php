<?php
namespace Pokapi\Hashing;

class Response
{

    /**
     * @var int
     */
    protected $locationAuthHash;

    /**
     * @var int
     */
    protected $locationHash;

    /**
     * @var int[]
     */
    protected $requestHashes;

    /**
     * Response constructor.
     *
     * @param int   $locationAuthHash
     * @param int   $locationHash
     * @param int[] $requestHashes
     */
    public function __construct(
        int $locationAuthHash,
        int $locationHash,
        array $requestHashes
    ) {
        $this->locationAuthHash = $locationAuthHash;
        $this->locationHash     = $locationHash;
        $this->requestHashes    = $requestHashes;
    }

    /**
     * @return int
     */
    public function getLocationAuthHash(): int
    {
        return $this->locationAuthHash;
    }

    /**
     * @return int
     */
    public function getLocationHash(): int
    {
        return $this->locationHash;
    }

    /**
     * @return int[]
     */
    public function getRequestHashes(): array
    {
        return $this->requestHashes;
    }
}
