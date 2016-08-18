<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\GetPlayerMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\GetPlayerResponse;
use Pokapi\Rpc\Request;

/**
 * Class GetPlayer
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class GetPlayer extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::GET_PLAYER();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        $player = new GetPlayerMessage();
        return $player;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new GetPlayerResponse($data);
    }
}
