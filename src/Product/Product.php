<?php

namespace MadeITBelgium\TeamLeader\Product;

/**
 * TeamLeader Laravel PHP SDK.
 *
 * @version    1.0.0
 *
 * @copyright  Copyright (c) 2018 Made I.T. (https://www.madeit.be)
 * @author     Tjebbe Lievens <tjebbe.lievens@madeit.be>
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-3.txt    LGPL
 */
class Product
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
     * Get a list of product categories.
     */
    public function categoriesList($data = [])
    {
        return $this->teamleader->getCall('productCategories.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get a list of products.
     */
    public function list($data = [])
    {
        return $this->teamleader->getCall('products.list', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Get details for a new product.
     */
    public function info($id)
    {
        return $this->teamleader->getCall('products.info', [
            'body' => json_encode(['id' => $id]),
        ]);
    }

    /**
     * Create a new product.
     */
    public function add($data)
    {
        return $this->teamleader->postCall('products.add', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Update a product.
     */
    public function update($id, $data)
    {
        $data['id'] = $id;

        return $this->teamleader->postCall('products.update', [
            'body' => json_encode($data),
        ]);
    }

    /**
     * Delete a product.
     */
    public function delete($id)
    {
        return $this->teamleader->postCall('products.delete', [
            'body' => json_encode(['id' => $id]),
        ]);
    }
}
