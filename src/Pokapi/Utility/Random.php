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
     *
     * @return float
     */
    public static function randomFloat($start, $stop) : float
    {
        return (float)mt_rand($start*10000, $stop*10000) / 10000;
    }
}
