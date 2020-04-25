<?php

namespace App\Tests;

use App\Service\Weather\OpenWeatherMapService;
use App\Entity\Weather;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\HttpClient\GuzzleHttpClient;

class OpenWeatherMapServiceTest extends KernelTestCase
{
    /**
     * @var OpenWeatherMapService
     */
    private $service;

    protected function setUp()
    {

        self::bootKernel();

        $apiKey = static::$kernel->getContainer()->getParameter('open_weather_map_api_key');
        $client = new GuzzleHttpClient();
        $this->service = new OpenWeatherMapService($client, $apiKey);
    }

    public function testGetLocationWeatherData()
    {
        $response = $this->service->getLocationWeatherData(0, 0);

        $this->assertIsObject($response);
        $this->assertEquals($response->cod, 200);
        $this->assertIsString($response->name);
        $this->assertEquals(1, count($response->weather));
    }

    public function testGetWeatherObject()
    {
        $response = $this->service->getWeatherObject(0, 0);

        $this->assertIsObject($response);
        $this->assertInstanceOf(Weather::class, $response);
        $this->assertIsString($response->getPlace());
        $this->assertIsNumeric($response->getTemperature());
        $this->assertIsNumeric($response->getWindSpeed());
        $this->assertIsString($response->getDescription());
    }
}