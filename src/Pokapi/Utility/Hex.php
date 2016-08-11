<?php
namespace Pokapi\Utility;

/**
 * Class Hex
 *
 * @package Pokapi\Utility
 * @author Freek Post <freek@kobalt.blue>
 */
class Hex
{

    /**
     * @param float $float
     * @return string
     */
    public static function float2hex(float $float) : string
    {
        return dechex(unpack('Q', pack('d', $float))[1]);
    }

    /**
     * @param float $float
     * @return string
     */
    public static function d2h(float $float)
    {
        return pack("H*", self::float2hex($float));
    }
}
