<?php

namespace App\Controller;

use App\Service\Harbor\HarbaHarborService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class HarborController extends AbstractController
{
    public function getHarbors(HarbaHarborService $harbaHarborService)
    {
        $harbors = $harbaHarborService->getHarborObjects();

        return new JsonResponse($harbors);
    }
}