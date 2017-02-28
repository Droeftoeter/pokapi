<?php
namespace Pokapi\Version;

class Latest implements Version
{

    /**
     * @return int
     */
    public function getVersion() : int
    {
        return 5703;
    }

    /**
     * @return string
     */
    public function getAndroidVersion() : string
    {
        return "0.57.3";
    }

    /**
     * @return int
     */
    public function getUnknown25() : int
    {
        return -816976800928766045;
    }

    /**
     * @return string
     */
    public function getPlatform8() : ?string
    {
       return "90f6a704505bccac73cec99b07794993e6fd5a12";
    }
}
