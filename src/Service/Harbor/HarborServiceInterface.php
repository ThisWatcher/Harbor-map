<?php

namespace App\Service\Harbor;

use App\Entity\Harbor;

interface HarborServiceInterface {

    /**
     * Gets data from api
     */
    public function getData();

    /**
     * Gets Harbors as object array
     * @return array[]|Harbor
     */
    public function getHarborObjects();

}