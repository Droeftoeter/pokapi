<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\CheckChallengeMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\CheckChallengeResponse;
use Pokapi\Rpc\Request;

/**
 * Class CheckChallenge
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class CheckChallenge extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::CHECK_CHALLENGE();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return new CheckChallengeMessage();
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new CheckChallengeResponse($data);
    }
}
