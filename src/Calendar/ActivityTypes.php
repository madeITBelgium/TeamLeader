<?php

namespace MadeITBelgium\TeamLeader\Calendar;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class ActivityTypes
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
     * Get a list of Activity Types.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('activityTypes.list?'.http_build_query($data));
    }
}
