<?php
namespace Pokapi\Utility;

/**
 * Class Random
 *
 * @package Pokapi\Utility
 * @author Freek Post <freek@kobalt.blue>
 */
class Random
{
    const MT_RAND_MAX = 2147483647; // Maximum value for 32bit Mersenne Twister, 2^31-1

    /**
     * Generate a random float between $start and $stop
     *
     * @param number $start
     * @param number $stop
     *
     * @return float
     */
    public static function randomFloat($start, $stop) : float
    {
        if ($start > $stop) {
            $temp = $start;
            $start = $stop;
            $stop = $temp;
        }
        return $start+mt_rand()/self::MT_RAND_MAX*($stop-$start);
    }
}
