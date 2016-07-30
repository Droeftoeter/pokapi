<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\GetMapObjectsMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\GetMapObjectsResponse;
use Pokapi\Rpc\Request;
use S2\S2CellId;
use S2\S2LatLng;

/**
 * Class GetMapObjects
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class GetMapObjects extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : int
    {
        return RequestType::GET_MAP_OBJECTS;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        $message = new GetMapObjectsMessage();
        $message->setLatitude($this->getLatitude());
        $message->setLongitude($this->getLongitude());
        $message->addAllCellId($this->getCellIds($this->getLatitude(), $this->getLongitude()));

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new GetMapObjectsResponse($data);
    }

    /**
     * Returns a list of cell ids for latitue and longitude.
     *
     * @param double $latitude
     * @param double $longitude
     * @param int    $width
     * @return array
     */
    public function getCellIds($latitude, $longitude, $width = 9)
    {
        // Create s2 instance from latitude and longitude
        $s2latLng = S2LatLng::fromDegrees($latitude, $longitude);
        // Get s2 cell id from latitude and longitude
        $cellId = S2CellId::fromLatLng($s2latLng)->parent(15);
        // Calculate the size
        $size = 1 * (2 ** (S2CellId::MAX_LEVEL - $cellId->level()));
        $index = 0;
        $jindex = 0;
        $face = $cellId->toFaceIJOrientation($index, $jindex);
        $cells = array();
        $halfWidth = (int)floor($width / 2);
        for ($x = -$halfWidth; $x <= $halfWidth; $x++) {
            for ($y = -$halfWidth; $y <= $halfWidth; $y++) {
                $s2CellID = S2CellId::fromFaceIJ($face, $index + $x * $size, $jindex + $y * $size);
                $cells[] = $s2CellID->parent(15)->id();
            }
        }
        return $cells;
    }
}
