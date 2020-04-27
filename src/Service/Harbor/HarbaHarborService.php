<?php

namespace App\Service\Harbor;

use App\Entity\Harbor;
use App\Service\HttpClient\GuzzleHttpClient;

class HarbaHarborService implements HarborServiceInterface
{

    /**
     * @var string
     */
    private $apiUrl = 'https://devapi.harba.co/harbors/visible';

    /**
     * @var string
     */
    private $imageHostUrl = 'https://devapi.harba.co';

    /**
     * @var GuzzleHttpClient
     */
    private $httpClient;

    /**
     * @param GuzzleHttpClient $httpClient
     */
    public function __construct(GuzzleHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @{inheritdoc}
     */
    public function getData()
    {
        $url = $this->apiUrl;

        return json_decode($this->httpClient->getResponseBody($url));
    }

    /**
     * @{inheritdoc}
     */
    public function getHarborObjects()
    {
        $results = $this->getData();
        $harbors = [];

        foreach ($results as $result) {
            $harbor = new Harbor();

            $harbor->setId($result->id);
            $harbor->setName($result->name);
            $harbor->setLat($result->lat);
            $harbor->setLon($result->lon);
            if (isset($result->image)) {
                $harbor->setImage($this->imageHostUrl . $result->image);
            }

            $harbors[] = $harbor;
        }

        return $harbors;
    }
}