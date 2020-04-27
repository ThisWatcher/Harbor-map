<?php

namespace App\Entity;

use JsonSerializable;

class Weather implements JsonSerializable
{
    /**
     * @var string
     */
    private $place;

    /**
     * @var int
     */
    private $temperature;

    /**
     * @var int
     */
    private $heatIndex;

    /**
     * @var int
     */
    private $windSpeed;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $weatherProvider;

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     * @return Weather
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return int
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param int $temperature
     * @return Weather
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeatIndex()
    {
        return $this->heatIndex;
    }

    /**
     * @param int $heatIndex
     * @return Weather
     */
    public function setHeatIndex($heatIndex)
    {
        $this->heatIndex = $heatIndex;
        return $this;
    }

    /**
     * @return int
     */
    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    /**
     * @param int $windSpeed
     * @return Weather
     */
    public function setWindSpeed($windSpeed)
    {
        $this->windSpeed = $windSpeed;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $descriptio
     * @return Weather
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeatherProvider()
    {
        return $this->weatherProvider;
    }

    /**
     * @param string $weatherProvider
     * @return Weather
     */
    public function setWeatherProvider(string $weatherProvider)
    {
        $this->weatherProvider = $weatherProvider;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'place' => $this->getPlace(),
            'name' => $this->getTemperature(),
            'heat_index' => $this->getHeatIndex(),
            'wind_speed' => $this->getWindSpeed(),
            'description' => $this->getDescription(),
            'weather_provider' => $this->getWeatherProvider(),
        ];
    }

}