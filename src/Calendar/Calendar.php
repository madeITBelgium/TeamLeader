<?php

namespace MadeITBelgium\TeamLeader\Calendar;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Calendar
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
     * Get the api for events.
     */
    public function event()
    {
        return new Event($this->teamleader);
    }

    /**
     * Get the api for events.
     */
    public function activityTypes()
    {
        return new ActivityTypes($this->teamleader);
    }
}
