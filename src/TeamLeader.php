<?php

namespace MadeITBelgium\TeamLeader;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use MadeITBelgium\TeamLeader\Calendar\Calendar;
use MadeITBelgium\TeamLeader\Crm\Crm;
use MadeITBelgium\TeamLeader\Deals\Deal;
use MadeITBelgium\TeamLeader\General\General;
use MadeITBelgium\TeamLeader\Invoicing\Invoicing;
use MadeITBelgium\TeamLeader\Milestones\Milestones;
use MadeITBelgium\TeamLeader\Product\Product;
use MadeITBelgium\TeamLeader\Projects\Projects;
use MadeITBelgium\TeamLeader\Tasks\Tasks;
use MadeITBelgium\TeamLeader\TimeTracking\TimeTracking;
use MadeITBelgium\TeamLeader\Webhooks\Webhook;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class TeamLeader
{
    protected $version = '1.10.0';
    protected $apiVersion = '1.0';
    private $apiServer = 'https://api.focus.teamleader.eu';
    private $authServer = 'https://focus.teamleader.eu';
    private $clientId;
    private $clientSecret;
    private $accessToken;
    private $refreshToken;
    private $expiresAt;
    private $scope;
    private $redirectUri;

    private $client;

    /**
     * Construct.
     *
     * @param $clientId
     * @param $clientSecret;
     * @param $client
     */
    public function __construct($apiUrl, $authUrl, $clientId, $clientSecret, $redirectUri, $client = null)
    {
        $this->apiServer = $apiUrl;
        $this->authServer = $authUrl;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;

        if ($client == null) {
            $this->createClient();
        } else {
            $this->client = $client;
        }
    }

    private function createClient()
    {
        $this->client = new Client([
            'timeout'  => 10.0,
            'headers'  => [
                'User-Agent' => 'Made I.T. PHP SDK V'.$this->version,
                'Accept'     => 'application/json',
            ],
            'verify' => true,
        ]);
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = Carbon::parse($expiresAt);
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function setRedirectUrl($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    public function getRedirectUrl($redirectUri)
    {
        return $this->redirectUri;
    }

    /**
     * Execute API call.
     *
     * @param $requestType
     * @param $endPoint
     * @param $data
     */
    private function call($requestType, $endPoint, $data = null)
    {
        $body = [];
        if ($data !== null && isset($data['multipart'])) {
            $body = $data;
        } elseif ($data !== null && isset($data['body'])) {
            $body = $data;
        } elseif ($data !== null) {
            $body = ['form_params' => $data];
        }

        $headers = $this->buildHeader();

        if (strpos($endPoint, 'oauth2') === false) {
            $endPoint = trim($this->apiServer, '/').'/'.ltrim($endPoint, '/');
        } else {
            $endPoint = trim($this->authServer, '/').'/'.ltrim($endPoint, '/');
        }

        try {
            $response = $this->client->request($requestType, $endPoint, $body + $headers);
        } catch (ServerException $e) {
            throw $e;
        } catch (ClientException $e) {
            \Log::info($e->getResponse()->getBody());

            throw $e;
            if ($e->getCode() == 400) {
                throw new Exception($e->getResponse(), $e->getCode(), $e); //Bad reqeust
            } elseif ($e->getCode() == 401) {
                throw new Exception($e->getResponse(), $e->getCode(), $e); //Unauthorized
            } elseif ($e->getCode() == 403) {
                throw new Exception($e->getResponse(), $e->getCode(), $e); //Forbidden
            } elseif ($e->getCode() == 404) {
                throw new Exception($e->getResponse(), $e->getCode(), $e); // Not Found
            } elseif ($e->getCode() == 429) {
                throw new Exception($e->getResponse(), $e->getCode(), $e); //To Many Requests
            } elseif ($e->getCode() == 500) {
                throw new Exception($e->getResponse(), $e->getCode(), $e); //Internal server error
            }

            throw $e;
        }

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201 || $response->getStatusCode() == 204) {
            $body = (string) $response->getBody();
        } else {
            throw new Exception('Invalid teamleader statuscode', $response->getStatusCode());
        }

        return json_decode($body);
    }

    public function buildHeader()
    {
        $headers = ['headers' => ['Content-Type' => 'application/json']];
        if (!empty($this->accessToken)) {
            $headers['headers']['Authorization'] = 'Bearer '.$this->accessToken;
        }

        return $headers;
    }

    public function postCall($endPoint, $data)
    {
        return $this->call('POST', $endPoint, $data);
    }

    public function getCall($endPoint, $data = null)
    {
        return $this->call('GET', $endPoint, $data);
    }

    public function putCall($endPoint, $data)
    {
        return $this->call('PUT', $endPoint, $data);
    }

    public function deleteCall($endPoint)
    {
        return $this->call('DELETE', $endPoint);
    }

    public function getAuthorizationUrl()
    {
        $query = [
            'client_id'     => $this->clientId,
            'response_type' => 'code',
            'redirect_uri'  => $this->redirectUri,
        ];

        $url = $this->authServer.'/oauth2/authorize?'.http_build_query($query);

        return $url;
    }

    public function requestAccessToken($code)
    {
        $result = $this->postCall('/oauth2/access_token', [
            'body' => json_encode([
                'code'          => $code,
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri'  => $this->redirectUri,
                'grant_type'    => 'authorization_code',
            ]),
        ]);

        $this->accessToken = $result->access_token;
        $this->expiresAt = Carbon::now()->addSeconds($result->expires_in);
        $this->refreshToken = $result->refresh_token;

        return $result;
    }

    public function regenerateAccessToken()
    {
        $result = $this->postCall('/oauth2/access_token', [
            'body' => json_encode([
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type'    => 'refresh_token',
                'refresh_token' => $this->refreshToken,
            ]),
        ]);

        $this->accessToken = $result->access_token;
        $this->expiresAt = Carbon::now()->addSeconds($result->expires_in);
        $this->refreshToken = $result->refresh_token;

        return $result;
    }

    public function checkAndDoRefresh()
    {
        if (Carbon::now()->gt($this->expiresAt)) {
            $result = $this->regenerateAccessToken();

            return $result;
        }

        return false;
    }

    public function general()
    {
        return new General($this);
    }

    public function crm()
    {
        return new Crm($this);
    }

    public function deals()
    {
        return new Deal($this);
    }

    public function calendar()
    {
        return new Calendar($this);
    }

    public function invoicing()
    {
        return new Invoicing($this);
    }

    public function product()
    {
        return new Product($this);
    }

    public function project()
    {
        return new Projects($this);
    }

    public function projectV2()
    {
        throw new \Exception('Not implemented yet. Create pull request');
    }

    public function timeTracking()
    {
        return new TimeTracking($this);
    }

    public function milestones()
    {
        return new Milestones($this);
    }

    public function tasks()
    {
        return new Tasks($this);
    }

    public function webhooks()
    {
        return new Webhook($this);
    }
}
