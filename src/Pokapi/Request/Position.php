<?php
namespace Pokapi\Request;

use Pokapi\Utility\Geo;
use Pokapi\Utility\Random;

/**
 * Class Position
 *
 * @package Pokapi\Request
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
     * @var float|int
     */
    protected $accuracy = 5;

    /**
     * Position constructor.
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     * @param float $accuracy
     */
    public function __construct(float $latitude, float $longitude, float $altitude = 8.0, $accuracy = 5.0)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
        $this->accuracy = $accuracy;
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
     * Return horizontal accuracy.
     *
     * @return float|int
     */
    public function getAccuracy()
    {
        return $this->accuracy;
    }

    /**
     * Creates a randomized version of this approximate position
     *
     * @param float $minDistance
     * @param float $maxDistance
     *
     * @return Position
     */
    public function createRandomized($minDistance = -0.010, $maxDistance = 0.010)
    {
        $newCoordinates = Geo::calculateNewCoordinates($this->latitude, $this->longitude, Random::randomFloat($minDistance, $maxDistance), rand(0,360));
        $newAltitude    = $this->altitude + round(Random::randomFloat(-2, 2), 2);
        $newAccuracy    = mt_rand(3, 10);
        return new self($newCoordinates[0], $newCoordinates[1], $newAltitude, $newAccuracy);
    }
}
