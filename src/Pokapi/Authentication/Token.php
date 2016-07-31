<?php
namespace Pokapi\Authentication;

use DateTime;
use DateInterval;

/**
 * Class Token
 *
 * @package Pokapi\Authentication
 * @author Freek Post <freek@kobalt.blue>
 */
class Token
{

    /**
     * @var string
     */
    protected $token;

    /**
     * @var DateTime
     */
    protected $expires;

    /**
     * Token constructor.
     *
     * @param string $token
     * @param int $expiry
     */
    public function __construct(string $token, int $expiry)
    {
        $this->token = $token;

        $expires = new DateTime();
        $expires->add(new DateInterval('PT' . $expiry . 'S'));
        $this->expires = $expires;
    }

    /**
     * Get the token
     *
     * @return string
     */
    public function getToken() : string
    {
        return $this->token;
    }

    /**
     * Get expiry
     *
     * @return DateTime
     */
    public function getExpiry() : DateTime
    {
        return $this->expires;
    }

    /**
     * Check if expired
     *
     * @return bool
     */
    public function hasExpired() : bool
    {
        $now = new DateTime();
        return $now <= $this->expires;
    }
}
