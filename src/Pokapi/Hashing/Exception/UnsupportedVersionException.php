<?php
namespace Pokapi\Hashing\Exception;
use Pokapi\Version\Version;

/**
 * Class Exception
 *
 * @package Pokapi\Hashing\Exception
 * @author Freek Post <freek@kobalt.blue>
 */
class UnsupportedVersionException extends Exception
{

    /**
     * UnsupportedVersionException constructor.
     *
     * @param Version $version
     */
    public function __construct(Version $version)
    {
        parent::__construct(sprintf("Version %s is not supported by this Hashing provider.", $version->getAndroidVersion()));
    }
}
