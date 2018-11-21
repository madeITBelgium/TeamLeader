<?php

namespace MadeITBelgium\TeamLeader\Crm;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Contact
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
     * Get a list of contacts.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('contacts.list?'.http_build_query($data));
    }

    /**
     * Get details for a single contact.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('contacts.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a new contact.
     */
    public function add($data)
    {
        return $this->teamleader->postCall('contacts.add', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a contact.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('contacts.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a contact.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('contacts.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Add a new or existing tag to a contact.
     */
    public function tag($id, $tags)
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        $data = ['id' => $id, 'tags' => $tags];

        return $this->teamleader->postCall('contacts.tag', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Remove a tag from a contact.
     */
    public function untag()
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }

        $data = ['id' => $id, 'tags' => $tags];

        return $this->teamleader->postCall('contacts.untag', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Link a contact to a company.
     */
    public function linkToCompany($id, $companyId, $position, $decisionMaker)
    {
        $data = [
            'id'             => $id,
            'company_id'     => $companyId,
            'position'       => $position,
            'decision_maker' => $decisionMaker,
        ];

        return $this->teamleader->postCall('contacts.linkToCompany', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Unlink a contact from a company.
     */
    public function unlinkToCompany($id, $companyId)
    {
        $data = [
            'id'         => $id,
            'company_id' => $companyId,
        ];

        return $this->teamleader->postCall('contacts.unlinkToCompany', [
            'body' => json_encode($data),
        ]);
    }
}
