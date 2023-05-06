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
class Invoicing
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
    public function invoices()
    {
        return new Invoices($this->teamleader);
    }

    /**
     * Get a list of subscriptions.
     */
    public function subscriptions()
    {
        return new Subscriptions($this->teamleader);
    }

    /**
     * Get a list of creditNotes.
     */
    public function creditNotes()
    {
        return new CreditNotes($this->teamleader);
    }

    /**
     * Get a list of taxRates.
     */
    public function taxRates()
    {
        return new TaxRates($this->teamleader);
    }

    /**
     * Get a list of withholdingTaxRates.
     */
    public function withholdingTaxRates()
    {
        return new WithholdingTaxRates($this->teamleader);
    }
}
