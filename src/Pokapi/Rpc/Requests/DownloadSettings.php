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
     * @var null|string
     */
    protected $hash;

    /**
     * DownloadSettings constructor.
     *
     * @param null|string $hash
     */
    public function __construct(string $hash = null)
    {
        $this->hash = $hash;
    }

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
        $message->setHash($this->hash);
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
