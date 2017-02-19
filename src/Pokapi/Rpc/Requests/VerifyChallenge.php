<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\VerifyChallengeMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\VerifyChallengeResponse;
use Pokapi\Rpc\Request;

/**
 * Class VerifyChallenge
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class VerifyChallenge extends Request
{

    /**
     * @var
     */
    protected $token;

    /**
     * CheckChallenge constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::VERIFY_CHALLENGE();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage() : VerifyChallengeMessage
    {
        $message = new VerifyChallengeMessage();
        $message->setToken($this->token);
        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data) : VerifyChallengeResponse
    {
        return new VerifyChallengeResponse($data);
    }
}
