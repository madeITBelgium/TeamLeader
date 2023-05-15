<?php

namespace MadeITBelgium\TeamLeader\Tasks;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Tasks
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
     * Get a list of tasks.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('tasks.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single tasks.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('tasks.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a task.
     */
    public function add($data)
    {
        return $this->teamleader->postCall('tasks.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a task.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('tasks.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a task.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('tasks.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Complete a task.
     */
    public function complete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('tasks.complete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Reopen a task.
     */
    public function reopen($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('tasks.open', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Schedule a task.
     */
    public function schedule($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('tasks.schedule', [
            'body' => json_encode($data),
        ]);
    }
}
