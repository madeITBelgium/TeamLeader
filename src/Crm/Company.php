<?php

namespace MadeITBelgium\TeamLeader\Crm;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.3.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Company
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
     * Get a list of companies.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('companies.list?'.http_build_query($data));
    }

    /**
     * Get details for a single company.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('companies.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a new company.
     */
    public function add($data)
    {
        return $this->teamleader->postCall('companies.add', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a company.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('companies.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a companies.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('companies.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Add a new or existing tag to a company.
     */
    public function tag($id, $tags)
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        $data = ['id' => $id, 'tags' => $tags];

        return $this->teamleader->postCall('companies.tag', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Remove a tag from a companiy.
     */
    public function untag($id, $tags)
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        $data = ['id' => $id, 'tags' => $tags];

        return $this->teamleader->postCall('companies.untag', [
            'body' => json_encode($data),
        ]);
    }
}
