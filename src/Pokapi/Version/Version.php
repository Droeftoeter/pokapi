<?php
namespace Pokapi\Version;

interface Version
{

    /**
     * @return int
     */
    public function getVersion() : int;

    /**
     * @return string
     */
    public function getAndroidVersion() : string;

    /**
     * @return int
     */
    public function getUnknown25() : int;

    /**
     * @return string
     */
    public function getPlatform8() : ?string;
}
