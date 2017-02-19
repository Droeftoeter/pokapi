<?php
namespace Pokapi;

use POGOProtos\Networking\Responses\CheckChallengeResponse;
use POGOProtos\Networking\Responses\DownloadSettingsResponse;
use POGOProtos\Networking\Responses\FortDetailsResponse;
use POGOProtos\Networking\Responses\GetGymDetailsResponse;
use POGOProtos\Networking\Responses\GetInventoryResponse;
use POGOProtos\Networking\Responses\GetMapObjectsResponse;
use POGOProtos\Networking\Responses\GetPlayerResponse;
use POGOProtos\Networking\Responses\MarkTutorialCompleteResponse;
use POGOProtos\Networking\Responses\VerifyChallengeResponse;
use Pokapi\Authentication;
use Pokapi\Hashing;
use Pokapi\Request\DeviceInfo;
use Pokapi\Request\Position;
use Pokapi\Rpc\Request;
use Pokapi\Rpc\Requests\CheckChallenge;
use Pokapi\Rpc\Requests\DownloadSettings;
use Pokapi\Rpc\Requests\GetGymDetails;
use Pokapi\Rpc\Requests\GetInventory;
use Pokapi\Rpc\Requests\GetMapObjects;
use Pokapi\Rpc\Requests\GetPlayer;
use Pokapi\Rpc\Requests\GetPokestopDetails;
use Pokapi\Rpc\Requests\MarkTutorialComplete;
use Pokapi\Rpc\Requests\VerifyChallenge;
use Pokapi\Rpc\Service;
use Pokapi\Version\Version;
use Psr\Log\LoggerInterface;

/**
 * Class API
 *
 * @package Pokapi
 * @author Freek Post <freek@kobalt.blue>
 */
class API
{

    /**
     * @var Position
     */
    protected $position;

    /**
     * @var DeviceInfo
     */
    protected $deviceInfo;

    /**
     * @var Service
     */
    protected $service;

    /**
     * API constructor.
     *
     * @param Version                 $version
     * @param Authentication\Provider $authProvider
     * @param Position                $position
     * @param DeviceInfo              $deviceInfo
     * @param Hashing\Provider|null   $hashingProvider
     * @param LoggerInterface|null    $logger
     */
    public function __construct(
        Version $version,
        Authentication\Provider $authProvider,
        Position $position,
        DeviceInfo $deviceInfo,
        Hashing\Provider $hashingProvider = null,
        LoggerInterface $logger = null
    ) {
        $this->service    = new Service($version, $authProvider, $deviceInfo, $hashingProvider, 3, $logger);
        $this->position   = $position;
        $this->deviceInfo = $deviceInfo;
    }

    /**
     * Sets the device information
     *
     * @param DeviceInfo $deviceInfo
     *
     * @return API
     */
    public function setDeviceInfo(DeviceInfo $deviceInfo) : self
    {
        $this->deviceInfo = $deviceInfo;
        return $this;
    }

    /**
     * Set the position
     *
     * @param Position $position
     *
     * @return API
     */
    public function setPosition(Position $position) : self
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Initialize
     *
     * @return array
     */
    public function initialize()
    {
        $messages = [
            new DownloadSettings()
        ];

        $collection = $this->service->batchExecute(
            $messages,
            $this->position
        );

        $responses = [];
        foreach ($collection as $response) {
            $responses[] = $response;
        }

        return array_map(function($response, Request $message){
            return $message->getResponse($response);
        }, $responses, $messages);
    }

    /**
     * Check if there is a CAPTCHA challenge.
     *
     * @return CheckChallengeResponse
     */
    public function checkChallenge() : CheckChallengeResponse
    {
        $request = new CheckChallenge();
        return $this->service->execute($request, $this->position);
    }

    /**
     * Verify token
     *
     * @param string $token
     *
     * @return VerifyChallengeResponse
     */
    public function verifyChallenge(string $token) : VerifyChallengeResponse
    {
        $request = new VerifyChallenge($token);
        return $this->service->execute($request, $this->position);
    }

    /**
     * Accept the terms
     *
     * @return MarkTutorialCompleteResponse
     */
    public function acceptTerms() : MarkTutorialCompleteResponse
    {
        $request = new MarkTutorialComplete();
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get player data
     *
     * @return GetPlayerResponse
     */
    public function getPlayerData() : GetPlayerResponse
    {
        $request = new GetPlayer();
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get player inventory
     *
     * @return GetInventoryResponse
     */
    public function getInventory() : GetInventoryResponse
    {
        $request = new GetInventory();
        return $this->service->execute($request, $this->position);
    }

    /**
     * Download settings
     *
     * @return DownloadSettingsResponse
     */
    public function downloadSettings() : DownloadSettingsResponse
    {
        $request = new DownloadSettings();
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get map objects
     *
     * @return GetMapObjectsResponse
     */
    public function getMapObjects() : GetMapObjectsResponse
    {
        $request = new GetMapObjects($this->position);
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get details for the given gym id/latitude/longitude and player lat/lng.
     * The maximum range for this query is ~900m from current player location.
     *
     * @param string $id
     * @param float $latitude
     * @param float $longitude
     * @return GetGymDetailsResponse
     */
    public function getGymDetails(string $id, float $latitude, float $longitude) : GetGymDetailsResponse
    {
        $request = new GetGymDetails($this->position, $id, $latitude, $longitude);
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get details for the given pokestop id at latitude/longitude.
     * The maximum range for this query is ~900m from current player location.
     *
     * @param string $id
     * @param float $latitude
     * @param float $longitude
     * @return FortDetailsResponse
     */
    public function getPokestopDetails(string $id, float $latitude, float $longitude) : FortDetailsResponse
    {
        $request = new GetPokestopDetails($id, $latitude, $longitude);
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get the Rpc service
     *
     * @return Service
     */
    public function getService() : Service
    {
        return $this->service;
    }
}
