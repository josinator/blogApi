<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Blog\Application\Query\GetAllPostsQuery;
use Common\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostListController extends AbstractController
{
    #[Route('/posts', name: 'api_posts_list', methods: ['GET'])]
    public function index(
        QueryBus $queryBus
    ): JsonResponse {
        try {
            $posts = $queryBus->handle(new GetAllPostsQuery());
        } catch (\Exception $e) {
            return new JsonResponse(json_encode(['message' => $e->getMessage()]), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $th) {
            return new JsonResponse(json_encode(['message' => $th->getMessage()]), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(json_encode($posts), Response::HTTP_OK);
    }
}
