<?php

declare(strict_types=1);

namespace App\Api;

use Blog\Application\Query\GetAllApiPostsQuery;
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
            $posts = $queryBus->handle(new GetAllApiPostsQuery());
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $th) {
            return new JsonResponse(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse($posts, Response::HTTP_OK);
    }
}
