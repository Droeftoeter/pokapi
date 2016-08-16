<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\GetInventoryMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\GetInventoryResponse;
use Pokapi\Rpc\Request;

/**
 * Class GetInventory
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class GetInventory extends Request
{

    /**
     * @var int|null
     */
    public static $lastRequest;

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::GET_INVENTORY();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        $message = new GetInventoryMessage();
        $message->setLastTimestampMs(self::$lastRequest);

        self::$lastRequest = round(microtime(true) * 1000);

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new GetInventoryResponse();
    }
}
