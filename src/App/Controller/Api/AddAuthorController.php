<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AddAuthorController extends AbstractController
{
    #[Route('/author/add', name: 'api_author_add', methods: ['POST'])]
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
