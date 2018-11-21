<?php

namespace MadeITBelgium\TeamLeader;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use \Exception;
use Carbon\Carbon;

use  MadeITBelgium\TeamLeader\Deals\Deal;
use  MadeITBelgium\TeamLeader\Crm\Crm;

/**
 * TeamLeader Laravel PHP SDK
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class TeamLeader
{
    
    protected $version = '1.0.0';
    protected $apiVersion = '1.0';
    private $server = 'https://app.teamleader.eu';
    private $clientId;
    private $clientSecret;
    private $accessToken;
    private $refreshToken;
    private $expiresAt;
    private $scope;
    private $redirectUri;

    private $client;

    /**
     * Construct Offrea.
     *
     * @param $clientId
     * @param $clientSecret;
     * @param $client
     */
    public function __construct($appUrl, $clientId, $clientSecret, $redirectUri, $client = null)
    {
        $this->server = $appUrl;
        $this->server = "https://private-anon-ecd4ce4920-teamleadercrm.apiary-proxy.com";
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;

        if ($client == null) {
            $this->client = new Client([
                'base_uri' => $this->server,
                'timeout'  => 10.0,
                'headers'  => [
                    'User-Agent' => 'Made I.T. PHP SDK V' . $this->version,
                    'Accept'     => 'application/json',
                ],
                'verify' => true,
            ]);
        } else {
            $this->client = $client;
        }
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

    public function setRedirectUrl($redirectUri) {
        $this->redirectUri = $redirectUri;
    }

    public function getRedirectUrl($redirectUri) {
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
        if($data !== null && isset($data['multipart'])) {
            $body = $data;
        }
        elseif($data !== null && isset($data['body'])) {
            $body = $data;
        }
        elseif ($data !== null) {
            $body = ['form_params' => $data];
        }

        $headers = $this->buildHeader();
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
            throw new Exception("Invalid teamleader statuscode", $response->getStatusCode());
        }

        return json_decode($body);
    }

    public function buildHeader()
    {
        $headers = ['headers' => ['Content-Type' => 'application/json']];
        if (!empty($this->accessToken)) {
            $headers['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
        }
        return $headers;
    }

    public function postCall($endPoint, $data)
    {
        return $this->call('POST', $endPoint, $data);
    }

    public function getCall($endPoint)
    {
        return $this->call('GET', $endPoint);
    }

    public function putCall($endPoint, $data)
    {
        return $this->call('PUT', $endPoint, $data);
    }

    public function deleteCall($endPoint)
    {
        return $this->call('DELETE', $endPoint);
    }

    public function getAuthorizationUrl() {
        $query = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri' => $this->redirectUri,
        ];
        return $this->server . "/oauth2/authorize?" . http_build_query($query);
    }

    public function requestAccessToken($code)
    {
        $result = $this->postCall('/oauth2/access_token',[
            'body' => json_encode([
                'code' => $code,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri' => $this->redirectUri,
                'grant_type' => 'authorization_code',
            ])
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
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->refreshToken,
            ])
        ]);

        $this->accessToken = $result->access_token;
        $this->expiresAt = Carbon::now()->addSeconds($result->expires_in);
        $this->refreshToken = $result->refresh_token;


        \Log::info('New Expires at:' . $this->expiresAt->format('Y-m-d H:i:s'));

        return $result;
    }

    public function checkAndDoRefresh()
    {
        \Log::info(Carbon::now()->format('Y-m-d H:i:s'));
        \Log::info($this->expiresAt->format('Y-m-d H:i:s'));
        
        if(Carbon::now()->gt($this->expiresAt)) {
            \Log::info('Regenerate tokens:');
            $result = $this->regenerateAccessToken();
            \Log::info(print_r($result, true));
            return $result;
        }
        return false;
    }

    
    public function general()
    {
        return null;
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
        return null;
    }
    
    public function invoicing()
    {
        return null;
    }
    
    public function product()
    {
        return null;
    }
    
    public function project()
    {
        return null;
    }
    
    public function timeTracking()
    {
        return null;
    }
    
    public function other()
    {
        return null;
    }
}