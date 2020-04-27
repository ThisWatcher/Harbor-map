<?php

namespace App\Controller;

use App\Service\Weather\OpenWeatherMapService;
use App\Service\Weather\WeatherResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    public function getLocationWeatherByCoordinates(Request $request, OpenWeatherMapService $openWeatherMapService)
    {
        $lat = intval($request->get('lat'));
        $lon = intval($request->get('lon'));

        if (!($lat >= -90 && $lat <= 90) || !($lon >= -180 && $lon <= 180)) {
            throw new \Exception('Latitude or Longitude out of bounds');
        }

        $weather = $openWeatherMapService->getWeatherObject($lat, $lon);
        $weatherResponse = new WeatherResponse($weather);

        return new JsonResponse([
            'status' => 'ok',
            'message' => $weatherResponse->getWeatherStringResponse()
        ]);
    }
}