<?php

namespace MadeITBelgium\TeamLeader\Webhooks;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Webhook
{
    private $teamleader;

    public function __construct($teamleader)
    {
        $this->setTeamleader($teamleader);
    }

    /**
     * set Teamleader.
     *
     * @param $teamleader
     */
    public function setTeamleader($teamleader)
    {
        $this->teamleader = $teamleader;
    }

    /**
     * get Teamleader.
     *
     * @param $teamleader
     */
    public function getTeamleader()
    {
        return $this->teamleader;
    }

    /**
     * List registered webhooks ordered by URL.
     */
    public function list()
    {
        return $this->teamleader->getCall('webhooks.list');
    }

    /**
     * Register a new webhook.
     */
    public function register($data)
    {
        return $this->teamleader->postCall('webhooks.register', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Unregister a webhook.
     */
    public function unregister($url, $types)
    {
        return $this->teamleader->postCall('webhooks.unregister', [
            'body' => json_encode([
                'url'   => $url,
                'types' => $types,
            ]),
        ]);
    }
}
