<?php

namespace App\Service\Weather;

use App\Entity\Weather;

class WeatherResponse {

    /**
     * @var Weather
     */
    protected $weather;

    public function __construct(Weather $weather)
    {
        $this->setWeather($weather);
    }

    public function getWeatherStringResponse()
    {
        $weather = $this->getWeather();
        $stringResponse = $weather->getPlace() . ': '
            . $weather->getTemperature() . '°C.'
            . ' Feels like ' . $weather->getHeatIndex() . '°C.'
            . ' Wind speed up to ' . $weather->getWindSpeed() .  'km/h. '
            . $weather->getDescription();

        return $stringResponse;
    }

    /**
     * @return Weather
     */
    public function getWeather()
    {
        return $this->weather;
    }

    /**
     * @param Weather $weather
     * @return WeatherResponse
     */
    public function setWeather(Weather $weather)
    {
        $this->weather = $weather;
        return $this;
    }
}