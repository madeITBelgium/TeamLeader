<?php

namespace MadeITBelgium\TeamLeader\Invoicing;

/**
 * TeamLeader Laravel PHP SDK - CreditNotes.
 *
 * @version    1.5.0
 *
 * @author     Sofian Mourabit
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class CreditNotes
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
     */
    public function getTeamleader()
    {
        return $this->teamleader;
    }

    /**
     * Get a list of credit notes.
     *
     */
    public function list($data = [])
    {
        return $this->teamleader->postCall('creditNotes.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single credit note.
     */
    public function info($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('invoices.info', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Download a credit note in a specific format.
     *
     */
    public function download($id, $format = 'pdf')
    {
        $data['id'] = $id;
        $data['format'] = $format;

        return $this->teamleader->postCall('creditNotes.download' , [
            'body' => json_encode($data),
        ]);
    }
}