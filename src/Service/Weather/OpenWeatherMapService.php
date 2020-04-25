<?php

namespace App\Service\Weather;

use App\Service\HttpClient\GuzzleHttpClient;
use App\Entity\Weather;

class OpenWeatherMapService implements WeatherServiceInterface
{

    /**
     * @var string
     */
    private $apiUrl = 'http://api.openweathermap.org/data/2.5/';

    /**
     * @var string
     */
    private $units = 'metric';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var GuzzleHttpClient
     */
    private $httpClient;

    /**
     * @param GuzzleHttpClient $httpClient
     * @param string $apiKey
     */
    public function __construct(GuzzleHttpClient $httpClient, $apiKey)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;
    }

    /**
     * @{inheritdoc}
     */
    public function getData($type, $param = null)
    {
        $url = $this->apiUrl.$type.'?';
        if (!isset($param['APPID'])) {
            $param['APPID'] = $this->apiKey;
        }
        if (!isset($param['units'])) {
            $param['units'] = $this->units;
        }
        $urlKeys = array();
        foreach ($param as $key => $value) {
            $urlKeys[] = $key.'='.rawurlencode($value);
        }
        $url .= implode('&', $urlKeys);

        return json_decode($this->httpClient->getResponseBody($url));
    }

    /**
     * @{inheritdoc}
     */
    public function getLocationWeatherData($lat, $lon)
    {
        $param = [
            'lat' => $lat,
            'lon' => $lon
        ];

        return $this->getData('weather', $param);
    }

    /**
     * @{inheritdoc}
     */
    public function getWeatherObject($lat, $lon)
    {
        $results = $this->getLocationWeatherData($lat, $lon);
        $weather = new Weather();

        if ($results->cod === 200) {
            $weather->setPlace($results->name);
            $weather->setTemperature(number_format($results->main->temp,1));
            $weather->setHeatIndex(number_format($results->main->feels_like,1));
            $weather->setWindSpeed(number_format($results->wind->speed,1));
            $weather->setDescription($results->weather[0]->main);
        }

        return $weather;
    }
}