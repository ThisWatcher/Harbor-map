<?php

namespace App\Service\HttpClient;

interface HttpClientInterface
{
    /**
     * @param string $url
     * @return string response body
     */
    public function getResponseBody($url);
}