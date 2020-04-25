<?php

namespace App\Service\Weather;

use App\Entity\Weather;

interface WeatherServiceInterface {

    /**
     * Gets data from api
     *
     * @param string $type
     * @param array $param
     */
    public function getData($type, $param);

    /**
     * Gets Location weather
     *
     * @param int $lat
     * @param int $lon
     *
     * @return mixed
     */
    public function getLocationWeatherData($lat, $lon);

    /**
     * Gets Weather as Object
     *
     * @param int $lat
     * @param int $lon
     *
     * @return Weather
     */
    public function getWeatherObject($lat, $lon);
}