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
     * @param string $gymId
     * @param float $gymLatitude
     * @param float $gymLongitude
     */
    public function __construct(Position $playerPosition, string $gymId, float $gymLatitude, float $gymLongitude) {
        $this->playerPosition = $playerPosition;
        $this->gymId = $gymId;
        $this->gymLatitude = $gymLatitude;
        $this->gymLongitude = $gymLongitude;
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