<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\GetHatchedEggsResponse;
use Pokapi\Rpc\Request;

/**
 * Class GetHatchedEggs
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class GetHatchedEggs extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::GET_HATCHED_EGGS();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new GetHatchedEggsResponse();
    }
}
