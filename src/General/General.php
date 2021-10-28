<?php

namespace MadeITBelgium\TeamLeader\General;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Invato B.V. (https://invato.nl)
 * @author     Geert Lucas Drenthe <gl@drenthe.it>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class General
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
     * Departments Endpoint.
     */
    public function department()
    {
        return new Department($this->teamleader);
    }

    /**
     * Users Endpoint.
     */
    public function user()
    {
        return new User($this->teamleader);
    }

    /**
     * Teams Endpoint.
     */
    public function team()
    {
        return new Team($this->teamleader);
    }

    /**
     * Custom Fields Endpoint.
     */
    public function customField()
    {
        return new CustomField($this->teamleader);
    }

    /**
     * Work Types Endpoint.
     */
    public function workType()
    {
        return new WorkType($this->teamleader);
    }
}
