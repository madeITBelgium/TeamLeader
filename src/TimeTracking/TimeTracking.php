<?php

namespace MadeITBelgium\TeamLeader\TimeTracking;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class TimeTracking
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
     * Get a list of time tracking items.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('timeTracking.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single timetracking item.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('timeTracking.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a timetracking item.
     */
    public function add($data)
    {
        return $this->teamleader->postCall('timeTracking.add', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update an timetracking item.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('timeTracking.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Resume an timetracking item.
     */
    public function resume($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('timeTracking.resume', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete an timetracking item.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('timeTracking.delete', [
            'body' => json_encode($data),
        ]);
    }
}
