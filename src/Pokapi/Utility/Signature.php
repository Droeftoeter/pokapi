<?php
namespace Pokapi\Utility;

class Signature
{
    public static function generateLocation1(string $authTicket, float $latitude, float $longitude, float $altitude = 0.0)
    {
        $seed = hexdec(xxhash32($authTicket, 0x1B845238));
        return hexdec(xxhash32(self::getLocationBytes($latitude, $longitude, $altitude), $seed));
    }

    public static function generateLocation2(float $latitude, float $longitude, float $altitude = 0.0) : int
    {
        return (int)hexdec(xxhash32(self::getLocationBytes($latitude, $longitude, $altitude), (int)hexdec(0x1B845238)));
    }

    public static function generateRequestHash(string $authTicket, string $request) : int
    {
        $seed = (int)hexdec(xxhash64($authTicket, (int)hexdec(0x1B845238)));
        return (int)hexdec(xxhash64($request, $seed));
    }

    protected static function getLocationBytes(float $latitude, float $longitude, float $altitude) : string
    {
        return Hex::d2h($latitude) . Hex::d2h($longitude) . Hex::d2h($altitude);
    }
}
