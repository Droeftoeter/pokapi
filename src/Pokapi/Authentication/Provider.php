<?php
namespace Pokapi\Authentication;

/**
 * Authentication Provider
 *
 * @package Pokapi\Authentication
 * @author Freek Post <freek@kobalt.blue>
 */
interface Provider
{

    /**
     * Get the type
     */
    public function getType() : string;

    /**
     * Get the access token
     *
     * @return Token
     */
    public function getToken() : Token;
}
