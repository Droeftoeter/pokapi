<?php
namespace Pokapi\Rpc;
use POGOProtos\Networking\Requests\RequestType;
use Protobuf\AbstractMessage;

/**
 * Base Rpc Request object
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
abstract class Request
{

    /**
     * @var float
     */
    protected $latitude;

    /**
     * @var float
     */
    protected $longitude;

    /**
     * @var float
     */
    protected $altitude;

    /**
     * @var string
     */
    protected $data;

    /**
     * Get the type
     *
     * @return RequestType
     */
    abstract public function getType() : RequestType;

    /**
     * Get an optional message
     *
     * @return AbstractMessage|null
     */
    abstract public function getMessage();

    /**
     * Get the response
     *
     * @param string $data
     *
     * @return AbstractMessage|null
     */
    abstract public function getResponse(string $data);

    /**
     * Create instance of request with coordinates
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return Request
     */
    public static function createWithCoordinates(float $latitude, float $longitude, float $altitude) : Request
    {
        $class = get_called_class();
        return new $class($latitude, $longitude, $altitude);
    }

    /**
     * Request constructor.
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     */
    public function __construct(float $latitude, float $longitude, float $altitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
    }

    /**
     * Get the latitude
     *
     * @return float
     */
    public function getLatitude() : float
    {
        return $this->latitude;
    }

    /**
     * Get the longitude
     *
     * @return float
     */
    public function getLongitude() : float
    {
        return $this->longitude;
    }

    /**
     * Get the altitude
     *
     * @return float
     */
    public function getAltitude() : float
    {
        return $this->altitude;
    }

    /**
     * Converts Rpc Request to protobuf request
     *
     * @return \POGOProtos\Networking\Requests\Request
     */
    public function toProtobufRequest()
    {
        $request = new \POGOProtos\Networking\Requests\Request();
        $request->setRequestType($this->getType());

        if (($message = $this->getMessage()) !== null) {
            $request->setRequestMessage($message->toStream()->getContents());
        }

        return $request;
    }
}
