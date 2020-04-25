<?php

namespace App\Tests;

use App\Entity\Harbor;
use App\Service\Harbor\HarbaHarborService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\HttpClient\GuzzleHttpClient;

class HarbaHarborServiceTest extends KernelTestCase
{
    /**
     * @var HarbaHarborService
     */
    private $service;

    protected function setUp()
    {

        self::bootKernel();

        $client = new GuzzleHttpClient();
        $this->service = new HarbaHarborService($client);
    }

    public function testGetAllHarbors()
    {
        $response = $this->service->getHarborObjects();
        $harbor = reset($response);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);

        $this->assertIsObject($harbor);
        $this->assertInstanceOf(Harbor::class, $harbor);
        $this->assertIsString($harbor->getId());
        $this->assertIsString($harbor->getName());
        $this->assertIsNumeric($harbor->getLat());
        $this->assertIsNumeric($harbor->getLon());
    }
}