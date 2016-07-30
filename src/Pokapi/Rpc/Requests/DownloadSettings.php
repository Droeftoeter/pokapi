<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\DownloadSettingsMessage;
use POGOProtos\Networking\Requests\RequestType;
use Pokapi\Rpc\Request;

/**
 * Class DownloadSettings
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class DownloadSettings extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : int
    {
        return RequestType::DOWNLOAD_SETTINGS;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        $message = new DownloadSettingsMessage();

        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return null;
    }
}
