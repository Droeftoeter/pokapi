<?php
namespace Pokapi\Utility;

/**
 * Class Signature
 *
 * @package Pokapi\Utility
 * @author Freek Post <freek@kobalt.blue>
 */
class Signature
{

    /**
     * Generate location1 hash
     *
     * @param string $authTicket
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return number
     */
    public static function generateLocation1(string $authTicket, float $latitude, float $longitude, float $altitude = 0.0)
    {
        $seed = hexdec(xxhash32($authTicket, 0x1B845238));
        return (int)hexdec(xxhash32(self::getLocationBytes($latitude, $longitude, $altitude), (int)$seed));
    }

    /**
     * Generate location2 hash
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return int
     */
    public static function generateLocation2(float $latitude, float $longitude, float $altitude = 0.0) : int
    {
        return (int)hexdec(xxhash32(self::getLocationBytes($latitude, $longitude, $altitude), 0x1B845238));
    }

    /**
     * Generate request hash
     *
     * @param string $authTicket
     * @param string $request
     *
     * @return int
     */
    public static function generateRequestHash(string $authTicket, string $request) : int
    {
        $seed = hexdec(xxhash64($authTicket, 0x1B845238));
        return (int)hexdec(xxhash64($request, (int)$seed));
    }

    /**
     * Get the location as bytes
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $altitude
     *
     * @return string
     */
    protected static function getLocationBytes(float $latitude, float $longitude, float $altitude) : string
    {
        return Hex::d2h($latitude) . Hex::d2h($longitude) . Hex::d2h($altitude);
    }
}
