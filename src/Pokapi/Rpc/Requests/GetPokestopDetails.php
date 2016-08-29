<?php

namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\FortDetailsMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\FortDetailsResponse;
use Pokapi\Rpc\Request;

class GetPokestopDetails extends Request{

    /** @var string */
    protected $id;

    /** @var float */
    protected $latitude;

    /** @var float */
    protected $longitude;

    /**
     * GetPokestopDetails constructor.
     *
     * @param $id
     * @param $latitude
     * @param $longitude
     */
    public function __construct($id, $latitude, $longitude) {
        $this->id = $id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::FORT_DETAILS();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage() : FortDetailsMessage
    {
        $message = new FortDetailsMessage();
        $message->setFortId($this->id);
        $message->setLatitude($this->latitude);
        $message->setLongitude($this->longitude);

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new FortDetailsResponse();
    }
}