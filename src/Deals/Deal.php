<?php

namespace MadeITBelgium\TeamLeader\Deals;

/**
 * TeamLeader Laravel PHP SDK
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Deal
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
     * Get a list of deals.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('deals.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single deal.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('deals.info', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * Create a new deal for a customer.
     */
    public function create($data)
    {
        return $this->teamleader->postCall('deals.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a deal.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('deals.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Move the deal to a different phase.
     */
    public function move($id, $phaseId)
    {
        $data['id'] = $id;
        $data['phase_id'] = $phaseId;
        return $this->teamleader->postCall('deals.move', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Mark a deal as won.
     */
    public function win($id)
    {
        $data['id'] = $id;
        return $this->teamleader->postCall('deals.win', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Mark a deal as lost.
     */
    public function lose($id, $reason_id = null, $extra_info = null)
    {
        $data['id'] = $id;
        if(!empty($reason_id)) {
            $data['reason_id'] = $reason_id;
        }
        if(!empty($extra_info)) {
            $data['extra_info'] = $extra_info;
        }

        return $this->teamleader->postCall('deals.lose', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a deal.
     */
    public function delete($id)
    {
        $data['id'] = $id;
        return $this->teamleader->postCall('deals.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a deal.
     */
    public function lostReasons($data = [])
    {
        return $this->teamleader->getCall('lostReasons.list', [
            'body' => json_encode($data),
        ]);
    }
}