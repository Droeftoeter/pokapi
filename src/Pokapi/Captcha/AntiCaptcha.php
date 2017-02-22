<?php
namespace Pokapi\Captcha;

use GuzzleHttp\Client;
use GuzzleHttp\Exception as GuzzleException;
use Pokapi\Captcha\AntiCaptcha\Exception\BalanceTooLowException;
use Pokapi\Captcha\AntiCaptcha\Exception\InvalidKeyException;
use Pokapi\Captcha\Exception\RemoteSolverException;
use Pokapi\Captcha\Exception\TimeoutException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class AntiCaptcha implements Solver
{

    /**
     * AntiCaptcha API URL
     */
    const HOST = "https://api.anti-captcha.com";

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $siteKey;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var int
     */
    protected $interval = 3;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AntiCaptcha constructor.
     *
     * @param string $apiKey
     * @param string $recaptchaSiteKey
     * @param int $timeout
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        string $apiKey,
        string $recaptchaSiteKey = '',
        int $timeout = 60,
        LoggerInterface $logger = null
    ) {
        $this->apiKey  = $apiKey;
        $this->siteKey = $recaptchaSiteKey;
        $this->logger  = $logger;
        $this->timeout = $timeout;
    }

    /**
     * Solve a challenge
     *
     * @param string $challengeUrl
     *
     * @return string
     *
     * @throws RemoteSolverException
     * @throws TimeoutException
     */
    public function solve(string $challengeUrl) : string
    {
        $result = $this->createTask($challengeUrl);

        if ($result['errorId'] !== 0) {
            $this->getLogger()->error(
                "Received AntiCaptcha ErrorId: {ErrorId}: {ErrorDescription}",
                [
                    'ErrorId'          => $result['errorId'],
                    'ErrorDescription' => $result['errorDescription']
                ]
            );

            if ($result['errorId'] == 1) {
                throw new InvalidKeyException();
            }

            if ($result['errorId'] == 10) {
                throw new BalanceTooLowException();
            }

            throw new RemoteSolverException(sprintf("AntiCaptcha error: %s: %s", $result['errorId'], $result['errorDescription']));
        }

        $this->getLogger()->debug("Task successfully created for challenge {Challenge}", ['Challenge' => $challengeUrl]);

        $taskId = $result['taskId'];

        $start = time();

        while (true) {
            if (time() - $start > $this->timeout) {
                throw new TimeoutException("AntiCaptcha waiting for result timed out after " . $this->timeout . " seconds.");
            }

            $result = $this->checkResult($taskId);

            if ($result === true) {
                sleep($this->interval);
                continue;
            }

            if ($result === false) {
                throw new RemoteSolverException("Remote error.");
            }

            return $result;
        }

        return false;
    }

    /**
     * Check if there is a result
     *
     * @param mixed $taskId
     *
     * @return bool|string
     *
     * @todo Clean this up
     *
     * @throws RemoteSolverException
     */
    protected function checkResult($taskId)
    {
        $this->getLogger()->debug("Requesting Task Status for task {TaskId}", ['TaskId' => $taskId]);

        $postData = [
            'clientKey' => $this->apiKey,
            'taskId'    => $taskId
        ];

        try {
            $response = $this->getClient()->post(static::HOST . '/getTaskResult', [
                'json' => $postData,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
        } catch (GuzzleException\RequestException $e) {
            $this->getLogger()->error("Guzzle Exception {Error}", ['Error' => $e]);
            throw new RemoteSolverException("Error fetching AntiCaptcha Task Status", 0, $e);
        }

        $decoded = json_decode($response->getBody(), true);

        if ($decoded === false) {
            $this->getLogger()->error("AntiCaptcha API error");
            return false;
        }

        if ($decoded['errorId'] !== 0) {
            $this->getLogger()->error(
                "Received AntiCaptcha ErrorId: {ErrorId}: {ErrorDescription}",
                [
                    'ErrorId'          => $decoded['errorId'],
                    'ErrorDescription' => $decoded['errorDescription']
                ]
            );
            throw new RemoteSolverException(sprintf("AntiCaptcha error: %s: %s", $decoded['errorId'], $decoded['errorDescription']));
        }

        if ($decoded['status'] == 'processing') {
            $this->getLogger()->debug("Task {TaskId} is still processing...", ['TaskId' => $taskId]);
            return true;
        }

        if ($decoded['status'] == 'ready') {
            $this->getLogger()->debug("Task {TaskId} completed.", ['TaskId' => $taskId]);
            return $decoded['solution']['gRecaptchaResponse'];
        }

        throw new RemoteSolverException(sprintf("Unknown status %s", $decoded['status']));
    }

    /**
     * @param string $challengeUrl
     *
     * @return array
     *
     * @throws RemoteSolverException
     */
    protected function createTask(string $challengeUrl) : array
    {
        $postData = [
            'clientKey' => $this->apiKey,
            'task'      => array(
                'type' => 'NoCaptchaTaskProxyLess',
                'websiteURL'    => $challengeUrl,
                'websiteKey'    => $this->siteKey
            )
        ];

        try {
            $response = $this->getClient()->post(static::HOST . '/createTask', [
                'json' => $postData,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
        } catch (GuzzleException\RequestException $e) {
            $this->getLogger()->error("Guzzle Exception {Error}", ['Error' => $e]);
            throw new RemoteSolverException("Error creating AntiCaptcha task.", 0, $e);
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * @return Client
     */
    protected function getClient() : Client
    {
        if (!$this->client instanceof Client) {
            $this->client = new Client([
                'headers' => [
                    'User-Agent'    => 'PHP-Pokapi'
                ],
                'connect_timeout' => 30,
                'verify' => false
            ]);
        }

        return $this->client;
    }

    /**
     * Get the logger
     *
     * @return LoggerInterface|NullLogger
     */
    protected function getLogger()
    {
        if (!$this->logger instanceof LoggerInterface) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }
}
