<?php

namespace MadeITBelgium\TeamLeader\Invoicing;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Invoices
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
     * Get a list of invoices.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('invoices.list?'.http_build_query($data));
    }

    /**
     * Get details for a single invoice.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('invoices.info?'.http_build_query(['id' => $id]));
    }

    /**
     * Add a new invoice.
     */
    public function draft($data)
    {
        return $this->teamleader->postCall('invoices.draft', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update an invoice.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('invoices.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete an invoice.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('invoices.delete', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Download an invoice in a specific format.
     */
    public function download($id, $format = 'pdf')
    {
        $data['id'] = $id;
        $data['format'] = $format;

        return $this->teamleader->postCall('invoices.download', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Creates a new draft invoice based on another invoice.
     */
    public function copy($id)
    {
        $data = ['id' => $id];

        return $this->teamleader->postCall('invoices.copy', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Book a draft invoice.
     */
    public function book($id, $on)
    {
        $data = ['id' => $id, 'on' => $on];

        return $this->teamleader->postCall('invoices.book', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Remove a tag from a invoice.
     */
    public function registerPayment($id, $paid_at, $amount, $currency = 'EUR')
    {
        $data = ['id' => $id, 'paid_at' => $paid_at, 'payment' => ['amount' => $amount, 'currency' => $currency]];

        return $this->teamleader->postCall('invoices.registerPayment', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Credit an invoice completely.
     */
    public function credit($id, $creditNoteDate)
    {
        $data = [
            'id'               => $id,
            'credit_note_date' => $creditNoteDate,
        ];

        return $this->teamleader->postCall('invoices.credit', [
            'body' => json_encode($data),
        ]);
    }
}
