<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostListController extends AbstractController
{
    #[Route('/posts', name: 'api_posts_list',methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse();
    }
}
