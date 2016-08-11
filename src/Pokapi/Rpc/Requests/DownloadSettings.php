<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Networking\Requests\Messages\DownloadSettingsMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\DownloadSettingsResponse;
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
    public function getType() : RequestType
    {
        return RequestType::DOWNLOAD_SETTINGS();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        $message = new DownloadSettingsMessage();
        $message->setHash('2788184af4004004d6ab0740f7632983332106f6');
        return $message;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new DownloadSettingsResponse($data);
    }
}
