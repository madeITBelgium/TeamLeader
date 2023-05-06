<?php

namespace MadeITBelgium\TeamLeader\Invoicing;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Maurice Bosch <m.bosch@digifactory.nl>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Subscriptions
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
     * Get a list of subscriptions.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('subscriptions.list?'.http_build_query($data));
    }

    /**
     * Get details for a single subscription.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('subscriptions.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a new subscription.
     */
    public function create($data)
    {
        return $this->teamleader->postCall('subscriptions.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a subscription.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('subscriptions.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Deactivate a subscription.
     */
    public function deactivate($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('subscriptions.deactivate', [
            'body' => json_encode($data),
        ]);
    }
}
