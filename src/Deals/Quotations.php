<?php

namespace MadeITBelgium\TeamLeader\Deals;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Quotations
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
     * Get a list of quotations.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('quotations.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single quotation.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('quotations.info', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * Create a new quotation for a customer.
     */
    public function create($data)
    {
        return $this->teamleader->postCall('quotations.create', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a quotation.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('quotations.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Mark a quotation as accepted.
     */
    public function accept($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('quotations.accept', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a quotation.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('quotations.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Download a quotation in a specific format.
     */
    public function download($id, $format = 'pdf')
    {
        $data['id'] = $id;
        $data['format'] = $format;

        return $this->teamleader->postCall('quotations.download', [
            'body' => json_encode($data),
        ]);
    }
}
