<?php
namespace Pokapi\Captcha;

use GuzzleHttp\Client;
use GuzzleHttp\Exception as GuzzleException;
use Pokapi\Captcha\AntiCaptcha\Exception\BalanceTooLowException;
use Pokapi\Captcha\AntiCaptcha\Exception\CurrentlyUnavailableException;
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
    protected $retryCount;

    /**
     * @var int
     */
    protected $interval = 3;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var int
     */
    protected $retryInterval = 6;

    /**
     * @var int
     */
    protected $currentRetries = 0;

    /**
     * AntiCaptcha constructor.
     *
     * @param string $apiKey
     * @param string $recaptchaSiteKey
     * @param int $timeout
     * @param int $retryCount
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        string $apiKey,
        string $recaptchaSiteKey = '',
        int $timeout = 60,
        int $retryCount = 3,
        LoggerInterface $logger = null
    ) {
        $this->apiKey     = $apiKey;
        $this->siteKey    = $recaptchaSiteKey;
        $this->logger     = $logger;
        $this->retryCount = $retryCount;
        $this->timeout    = $timeout;
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
     * @throws InvalidKeyException
     * @throws BalanceTooLowException
     * @throws CurrentlyUnavailableException
     * @throws RemoteSolverException
     */
    protected function checkResult($taskId)
    {
        $this->getLogger()->debug("Requesting Task Status for task {TaskId}", ['TaskId' => $taskId]);

        $response = $this->sendRequest('getTaskResult', ['taskId' => $taskId]);

        if ($response['status'] == 'processing') {
            $this->getLogger()->debug("Task {TaskId} is still processing...", ['TaskId' => $taskId]);
            return true;
        }

        if ($response['status'] == 'ready') {
            $this->getLogger()->debug("Task {TaskId} completed.", ['TaskId' => $taskId]);
            return $response['solution']['gRecaptchaResponse'];
        }

        throw new RemoteSolverException(sprintf("Unknown status %s", $response['status']));
    }

    /**
     * @param string $challengeUrl
     *
     * @return array
     *
     * @throws InvalidKeyException
     * @throws BalanceTooLowException
     * @throws RemoteSolverException
     * @throws CurrentlyUnavailableException
     */
    protected function createTask(string $challengeUrl) : array
    {
        try {
            $response = $this->sendRequest('createTask', [
                'task' => [
                    'type'       => 'NoCaptchaTaskProxyless',
                    'websiteURL' => $challengeUrl,
                    'websiteKey' => $this->siteKey
                ]
            ]);
        } catch (CurrentlyUnavailableException $e) {
            $this->currentRetries++;

            /* Rethrow if retryCount exceeded. */
            if ($this->currentRetries > $this->retryCount) {
                throw $e;
            }

            /* Wait a while */
            sleep($this->retryInterval);

            return $this->createTask($challengeUrl);
        }

        /* Reset retries */
        $this->currentRetries = 0;

        return $response;
    }

    /**
     * Send a request to AntiCaptcha
     *
     * @param string $method
     * @param array $postData
     * @return array
     *
     * @throws BalanceTooLowException
     * @throws CurrentlyUnavailableException
     * @throws InvalidKeyException
     * @throws RemoteSolverException
     */
    protected function sendRequest(string $method, array $postData) : array
    {
        $postData = array_merge([
            'clientKey' => $this->apiKey
        ], $postData);

        try {
            $response = $this->getClient()->post(static::HOST . '/' . $method, [
                'json' => $postData,
                'headers' => [
                    'Content-Type' => 'application/json'
                ]
            ]);
        } catch (GuzzleException\RequestException $e) {
            $this->getLogger()->error("Guzzle Exception {Error}", ['Error' => $e]);
            throw new RemoteSolverException("Error creating AntiCaptcha task.", 0, $e);
        }

        $jsonResponse = json_decode($response->getBody(), true);

        if ($jsonResponse === false) {
            $this->getLogger()->error("AntiCaptcha API error");
            throw new RemoteSolverException("AntiCaptcha API Error. Invalid JSON response.");
        }

        if ($jsonResponse['errorId'] !== 0) {
            $this->getLogger()->error(
                "Received AntiCaptcha ErrorId: {ErrorId}: {ErrorDescription}",
                [
                    'ErrorId'          => $jsonResponse['errorId'],
                    'ErrorDescription' => $jsonResponse['errorDescription']
                ]
            );

            if ($jsonResponse['errorId'] == 1) {
                $this->getLogger()->alert("AntiCaptcha key is invalid.");
                throw new InvalidKeyException();
            }

            if ($jsonResponse['errorId'] == 2) {
                $this->getLogger()->info("No idle workers available at the moment.");
                throw new CurrentlyUnavailableException();
            }

            if ($jsonResponse['errorId'] == 10) {
                $this->getLogger()->alert("Your AntiCaptcha balance is too low.");
                throw new BalanceTooLowException();
            }

            throw new RemoteSolverException(sprintf("AntiCaptcha error: %s: %s", $jsonResponse['errorId'], $jsonResponse['errorDescription']));
        }

        return $jsonResponse;
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
