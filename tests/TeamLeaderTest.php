<?php

use PHPUnit\Framework\TestCase;
use MadeITBelgium\TeamLeader\TeamLeader;
use GuzzleHttp\Client;

class TeamLeaderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testConstructor()
    {
        $client = new Client([
            'base_uri' => 'http://localhost',
            'timeout'  => 5.0,
            'headers'  => [
                'Accept'     => 'application/json',
            ],
            'verify' => true,
        ]);
        $teamleader = new TeamLeader('http://localhost', 'client_id', 'client_secret', 'http://localhost', $client);

        $this->assertEquals('client_id', $teamleader->getClientId());
        $this->assertEquals('client_secret', $teamleader->getClientSecret());
    }
}
