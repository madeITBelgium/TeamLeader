<?php

namespace MadeITBelgium\TeamLeader\Projects;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2023 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Projects
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
     * Get a list of projects.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('projects.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a new projects.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('projects.info', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * Create a new projects.
     */
    public function create($data)
    {
        return $this->teamleader->postCall('projects.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a product.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('projects.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Close a project.
     */
    public function close($id)
    {
        return $this->teamleader->postCall('projects.close', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * reopen a project.
     */
    public function reopen($id)
    {
        return $this->teamleader->postCall('projects.reopen', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * delete a project.
     */
    public function delete($id)
    {
        return $this->teamleader->postCall('projects.delete', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * addParticipant to a project.
     */
    public function addParticipant($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('projects.addParticipant', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * addParticipant to a project.
     */
    public function addParticipant($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('projects.updateParticipant', [
            'body' => json_encode($data),
        ]);
    }
}
