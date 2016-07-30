<?php
namespace Pokapi\Authentication;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class TrainersClub
 *
 * @package Pokapi\Authentication
 * @author Freek Post <freek@kobalt.blue>
 */
class TrainersClub implements Provider
{

    const LOGIN_URL = 'https://sso.pokemon.com/sso/login?service=https%3A%2F%2Fsso.pokemon.com%2Fsso%2Foauth2.0%2FcallbackAuthorize';
    const LOGIN_OAUTH = 'https://sso.pokemon.com/sso/oauth2.0/accessToken';
    const LOGIN_SECRET = 'w8ScCUXJQc6kXKw8FiOhd8Fixzht18Dq3PEVkUCP5ZPxtgyWsbTvWHFLm2wNY0JR';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * TrainersClub constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->client = new Client([
            'cookies'    => true,
            'verifyPeer' => false
        ]);

        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the authentication type
     *
     * @return string
     */
    public function getType() : string
    {
        return 'ptc';
    }

    /**
     * {@inheritdoc}
     */
    public function getToken() : string
    {
        // Initialize token
        $ticket = null;

        $executionToken = $this->fetchExecutionToken();

        // Make request
        try {
            $this->client->post(self::LOGIN_URL, [
                'headers' => [
                    'User-Agent' => 'niantic'
                ],
                'allow_redirects' => [
                    'on_redirect' => function(Request $request, Response $response) use (&$ticket){
                        // Extract ticket from HTTP-Location header.
                        preg_match('/ticket=(.+)/', $response->getHeaderLine('Location'), $matches);
                        if (isset($matches[1])) {
                            $ticket = $matches[1];
                        }
                    }
                ],
                'form_params' => [
                    'lt' => $executionToken->lt,
                    'execution' => $executionToken->execution,
                    '_eventId' => 'submit',
                    'username' => $this->username,
                    'password' => $this->password,
                ]
            ]);
        } catch(ServerException $exception) {
            // This is expected...
        }

        if ($ticket === null) {
            throw new \Exception("No token....");
        }

        // Make oAuth request
        try {
            $response = $this->client->post(self::LOGIN_OAUTH, [
                'headers' => [
                    'User-Agent' => 'niantic'
                ],
                'form_params' => [
                    'client_id' => 'mobile-app_pokemon-go',
                    'redirect_uri' => 'https://www.nianticlabs.com/pokemongo/error',
                    'client_secret' => self::LOGIN_SECRET,
                    'grant_type' => 'refresh_token',
                    'code' => $ticket
                ]
            ]);
        } catch(ServerException $e) {
            throw new \Exception($e);
        }

        parse_str($response->getBody()->getContents(), $data);

        if (isset($data['access_token'])) {
            return $data['access_token'];
        }

        throw new \Exception("No access token :(");
    }

    /**
     * Get data we need
     *
     * @return mixed
     * @throws \Exception
     */
    protected function fetchExecutionToken()
    {
        $response = $this->client->get(self::LOGIN_URL, [
            'headers' => [
                'User-Agent' => 'niantic'
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Wrong Response " . $response->getStatusCode());
        }

        $jsonData = json_decode($response->getBody()->getContents());

        if ($jsonData) {
            return $jsonData;
        }
    }
}
