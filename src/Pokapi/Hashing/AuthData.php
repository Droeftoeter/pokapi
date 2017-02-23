<?php
namespace Pokapi\Hashing;

use POGOProtos\Networking\Envelopes\RequestEnvelope\AuthInfo;
use Pokapi\Hashing\Exception\NoAuthDataException;
use Pokapi\Rpc\AuthTicket;

class AuthData
{

    /**
     * @var null|AuthInfo
     */
    protected $authInfo;

    /**
     * @var null|AuthTicket
     */
    protected $authTicket;

    /**
     * AuthData constructor.
     *
     * @param AuthInfo|null   $authInfo
     * @param AuthTicket|null $authTicket
     */
    public function __construct(AuthInfo $authInfo = null, AuthTicket $authTicket = null)
    {
        $this->authInfo   = $authInfo;
        $this->authTicket = $authTicket;
    }

    /**
     * @param AuthTicket $authTicket
     *
     * @return AuthData
     */
    public static function withAuthTicket(AuthTicket $authTicket)
    {
        return new self(null, $authTicket);
    }

    /**
     * @param AuthInfo $authInfo
     *
     * @return AuthData
     */
    public static function withAuthInfo(AuthInfo $authInfo)
    {
        return new self($authInfo);
    }

    /**
     * @return string
     *
     * @throws NoAuthDataException
     */
    public function getData()
    {
        if ($this->authInfo === null && $this->authTicket === null) {
            throw new NoAuthDataException("No AuthTicket and no AuthInfo set.");
        }

        if ($this->authTicket === null) {
            return $this->authInfo->getToken()->toStream()->getContents();
        }

        return $this->authTicket->toProto()->toStream()->getContents();
    }
}
