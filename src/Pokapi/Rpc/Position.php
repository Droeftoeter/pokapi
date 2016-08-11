<?php
namespace Pokapi\Rpc;

class Position
{

    protected $latitude;

    protected $longitude;

    protected $altitude = 8;

    public function __construct(float $latitude, float $longitude, float $altitude = 8)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->altitude = $altitude;
    }

    public function getLatitude() : float
    {
        return $this->latitude;
    }

    public function getLongitude() : float
    {
        return $this->longitude;
    }

    public function getAltitude()
    {
        return $this->altitude;
    }
}
