<?php

namespace App\Tests;

use App\Entity\Weather;
use App\Service\Weather\WeatherResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WeatherResponseTest extends KernelTestCase
{
    /**
     * @var WeatherResponse
     */
    private $weatherResponse;

    protected function setUp()
    {
        self::bootKernel();

        $weather = (new Weather())
            ->setWindSpeed(5)
            ->setHeatIndex(6)
            ->setDescription('test')
            ->setPlace('test');

        $this->weatherResponse = new WeatherResponse($weather);
    }

    public function testGetWeatherStringResponse()
    {
        $response = $this->weatherResponse->getWeatherStringResponse();

        $this->assertIsString($response);
        $this->assertContains('test', $response);
        $this->assertContains('5', $response);
        $this->assertContains('6', $response);
    }
}