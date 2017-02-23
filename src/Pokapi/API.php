<?php
namespace Pokapi;

use POGOProtos\Networking\Responses\DownloadSettingsResponse;
use POGOProtos\Networking\Responses\FortDetailsResponse;
use POGOProtos\Networking\Responses\GetGymDetailsResponse;
use POGOProtos\Networking\Responses\GetInventoryResponse;
use POGOProtos\Networking\Responses\GetMapObjectsResponse;
use POGOProtos\Networking\Responses\GetPlayerResponse;
use POGOProtos\Networking\Responses\MarkTutorialCompleteResponse;
use POGOProtos\Networking\Responses\VerifyChallengeResponse;
use Pokapi\Authentication;
use Pokapi\Captcha\Exception\Exception;
use Pokapi\Captcha\Solver;
use Pokapi\Exception\FailedCaptchaException;
use Pokapi\Hashing;
use Pokapi\Request\DeviceInfo;
use Pokapi\Request\Position;
use Pokapi\Rpc\Request;
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
use Psr\Log\NullLogger;

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
     * @var Solver
     */
    protected $captchaSolver;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * API constructor.
     *
     * @param Version                 $version
     * @param Authentication\Provider $authProvider
     * @param Position                $position
     * @param DeviceInfo              $deviceInfo
     * @param Hashing\Provider|null   $hashingProvider
     * @param LoggerInterface|null    $logger
     * @param Solver|null             $captchaSolver
     */
    public function __construct(
        Version $version,
        Authentication\Provider $authProvider,
        Position $position,
        DeviceInfo $deviceInfo,
        Hashing\Provider $hashingProvider = null,
        LoggerInterface $logger = null,
        Solver $captchaSolver = null
    ) {
        $this->service       = new Service($version, $authProvider, $deviceInfo, $hashingProvider, 3, $captchaSolver, $logger);
        $this->position      = $position;
        $this->deviceInfo    = $deviceInfo;
        $this->captchaSolver = $captchaSolver;
        $this->logger        = $logger;
    }

    /**
     * @param Solver $solver
     *
     * @return API
     */
    public function setCaptchaSolver(Solver $solver) : self
    {
        $this->captchaSolver = $solver;
        return $this;
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
     * Returns the challenge if there is
     * Returns false if there is not.
     *
     * Will attempt to solve the Captcha if a Solver is defined.
     *
     * @return string|bool
     *
     * @throws Exception
     * @throws FailedCaptchaException
     */
    public function checkChallenge()
    {
        return $this->service->checkChallenge($this->position);
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
        return $this->executeRequest($request);
    }

    /**
     * Accept the terms
     *
     * @return MarkTutorialCompleteResponse
     */
    public function acceptTerms() : MarkTutorialCompleteResponse
    {
        $request = new MarkTutorialComplete();
        return $this->executeRequest($request);
    }

    /**
     * Get player data
     *
     * @return GetPlayerResponse
     */
    public function getPlayerData() : GetPlayerResponse
    {
        $request = new GetPlayer();
        return $this->executeRequest($request);
    }

    /**
     * Get player inventory
     *
     * @return GetInventoryResponse
     */
    public function getInventory() : GetInventoryResponse
    {
        $request = new GetInventory();
        return $this->executeRequest($request);
    }

    /**
     * Download settings
     *
     * @return DownloadSettingsResponse
     */
    public function downloadSettings() : DownloadSettingsResponse
    {
        $request = new DownloadSettings();
        return $this->executeRequest($request);
    }

    /**
     * Get map objects
     *
     * @return GetMapObjectsResponse
     */
    public function getMapObjects() : GetMapObjectsResponse
    {
        $request = new GetMapObjects($this->position);
        return $this->executeRequest($request);
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
        return $this->executeRequest($request);
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
        return $this->executeRequest($request);
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

    /**
     * Execute a request
     *
     * @param Request $request
     *
     * @return \Protobuf\AbstractMessage
     */
    protected function executeRequest(Request $request)
    {
        return $this->service->execute($request, $this->position);
    }

    /**
     * Get the logger
     *
     * @return LoggerInterface
     */
    protected function getLogger() : LoggerInterface
    {
        if (!$this->logger instanceof LoggerInterface) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }
}
