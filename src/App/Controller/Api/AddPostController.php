<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AddPostController extends AbstractController
{
    #[Route('/post/add', name: 'api_post_add', methods: ['POST'])]
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
