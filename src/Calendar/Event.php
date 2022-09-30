<?php

namespace MadeITBelgium\TeamLeader\Calendar;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Event
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
     * Get a list of events.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('events.list?'.http_build_query($data));
    }

    /**
     * Get details for a single event.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('events.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Create a new event.
     */
    public function create($data)
    {
        return $this->teamleader->postCall('events.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update an event.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('events.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Cancel an event.
     */
    public function cancel($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('events.cancel', [
            'body' => json_encode($data),
        ]);
    }
}
