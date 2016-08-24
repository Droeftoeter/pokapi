<?php

namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\GetGymDetailsMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\GetGymDetailsResponse;
use Pokapi\Request\Position;
use Pokapi\Rpc\Request;

/**
 * Class GetGymDetails
 *
 * @package Pokapi\Rpc\Requests
 */
class GetGymDetails extends Request
{
    /**
     * @var Position
     */
    protected $playerPosition;

    /**
     * @var string
     */
    protected $gymId;

    /**
     * @var float
     */
    protected $gymLatitude;

    /**
     * @var float
     */
    protected $gymLongitude;

    /**
     * GetGymDetails constructor.
     *
     * @param Position $playerPosition
     * @param string $id
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(Position $playerPosition, string $id, float $latitude, float $longitude) {
        $this->playerPosition = $playerPosition;
        $this->gymId = $id;
        $this->gymLatitude = $latitude;
        $this->gymLongitude = $longitude;
    }

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::GET_GYM_DETAILS();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage() : GetGymDetailsMessage
    {
        $message = new GetGymDetailsMessage();
        $message->setPlayerLatitude($this->playerPosition->getLatitude());
        $message->setPlayerLongitude($this->playerPosition->getLongitude());
        $message->setGymId($this->gymId);
        $message->setGymLatitude($this->gymLatitude);
        $message->setGymLongitude($this->gymLongitude);
        $message->setClientVersion('0.33.0');

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new GetGymDetailsResponse($data);
    }
}