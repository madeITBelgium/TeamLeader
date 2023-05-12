<?php

namespace MadeITBelgium\TeamLeader\Milestones;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Milestones
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
     * Get a list of milestones.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('milestones.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single milestone.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('milestones.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a milestone.
     */
    public function add($data)
    {
        return $this->teamleader->postCall('milestones.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a milestone.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('milestones.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a milestone.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('milestones.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Close a milestone.
     */
    public function close($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('milestones.close', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Open a milestone.
     */
    public function open($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('milestones.open', [
            'body' => json_encode($data),
        ]);
    }
}
