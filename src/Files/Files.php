<?php

namespace MadeITBelgium\TeamLeader\Files;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.5.0
 *
 * @author     Sofian Mourabit
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Files
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
     * Get a list of files.
     */
    public function list($data = [])
    {
        return $this->teamleader->postCall('files.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a single file.
     */
    public function info($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('files.info', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Request the download link for a file.
     */
    public function download($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('files.download', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Request the upload link for a file.
     */
    public function upload($name, $subject = [], $folder = 'General')
    {
        $data = [
            'name' => $name,
            'subject' => $subject,
            'folder' => $folder,
        ];
        return $this->teamleader->postCall('files.upload', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a file.
     */
    public function delete($id)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('files.delete', [
            'body' => json_encode($data),
        ]);
    }
}
