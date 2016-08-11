<?php
namespace Pokapi\Utility;

class Hex
{

    public static function float2hex(float $float) : string
    {
        return dechex(unpack('Q', pack('d', $float))[1]);
    }

    public static function d2h(float $float)
    {
        return pack("H*", self::float2hex($float));
    }
}
