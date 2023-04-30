<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostController extends AbstractController
{
    #[Route('/post/{id}', name: 'api_post_detail', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
