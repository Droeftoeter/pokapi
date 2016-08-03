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
        //$message->setHash('b1f2bf509a025b7cd76e1c484e2a24411c50f061');

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
