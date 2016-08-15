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

    /**
     * Generate a random float
     *
     * @param number $start
     * @param number $stop
     * @param int $resolution
     *
     * @return float
     */
    public static function randomFloat($start, $stop, $resolution = 10000) : float
    {
        return (float)mt_rand($start*$resolution, $stop*$resolution) / $resolution;
    }
}
