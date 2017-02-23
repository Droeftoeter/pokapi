<?php
namespace Pokapi\Exception;
use Exception;

/**
 * Class FlaggedAccountException
 *
 * @package Pokapi\Exception
 * @author Freek Post <freek@kobalt.blue>
 */
class FlaggedAccountException extends Exception
{

    /**
     * @var string
     */
    protected $challengeUrl;

    /**
     * FlaggedAccountException constructor.
     *
     * @param string $challengeUrl
     */
    public function __construct(string $challengeUrl)
    {
        parent::__construct("Account has been flagged for CAPTCHA.");

        $this->challengeUrl = $challengeUrl;
    }

    /**
     * Get the challengeUrl
     *
     * @return string
     */
    public function getChallengeUrl() : string
    {
        return $this->challengeUrl;
    }
}
