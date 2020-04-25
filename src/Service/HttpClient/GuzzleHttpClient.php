<?php

namespace App\Service\HttpClient;

use GuzzleHttp\Client;
use mysql_xdevapi\Exception;

class GuzzleHttpClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @{inheritdoc}
     */
    public function getResponseBody($url)
    {
        try {
            $request = $this->client->request('GET', $url);
        } catch (Exception $exception) {
            dump($exception);
            die();
            return $exception;
        }

        return $request->getBody();
    }
}