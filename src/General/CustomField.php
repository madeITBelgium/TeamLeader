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
class CustomField
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
     * Get a list of custom fields.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('customFieldDefinitions.list?'.http_build_query($data));
    }

    /**
     * Get details for a single custom field.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('customFieldDefinitions.info?'.http_build_query(['id' => $id]));
    }
}
