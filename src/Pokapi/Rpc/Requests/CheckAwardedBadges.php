<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\CheckAwardedBadgesMessage;
use POGOProtos\Networking\Responses\CheckAwardedBadgesResponse;
use POGOProtos\Networking\Requests\RequestType;
use Pokapi\Rpc\Request;

/**
 * Class CheckAwardedBadges
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class CheckAwardedBadges extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::CHECK_AWARDED_BADGES();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return new CheckAwardedBadgesMessage();
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new CheckAwardedBadgesResponse();
    }
}
