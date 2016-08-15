<?php
namespace Pokapi\Rpc;

use Pokapi\Utility\Geo;
use Pokapi\Utility\Random;

/**
 * Class Position
 *
 * @package Pokapi\Rpc
 * @author Freek Post <freek@kobalt.blue>
 */
class Position
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
     * @var float|int
     */
    protected $altitude = 8;

    /**
     * Position constructor.
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     */
    public function __construct(float $latitude, float $longitude, float $altitude = 8)
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
     * @return float|int
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * Creates a randomized version of this approximate position
     *
     * @return Position
     */
    public function createRandomized()
    {
        $newCoordinates = Geo::calculateNewCoordinates($this->latitude, $this->longitude, Random::randomFloat(-0.005, 0.005), rand(0,360));
        $newAltitude    = $this->altitude + Random::randomFloat(-2, 2);
        return new self($newCoordinates[0], $newCoordinates[1], $newAltitude);
    }
}
