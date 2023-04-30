<?php

declare(strict_types=1);

namespace App\Api;

use Blog\Application\Query\GetPostByIdQuery;
use Common\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostController extends AbstractController
{
    #[Route('/post/{id}', name: 'api_post_detail', methods: ['GET'])]
    public function index(
        QueryBus $queryBus,
        int $id
    ): JsonResponse {
        try {
            $postDto = $queryBus->handle(new GetPostByIdQuery($id));
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $th) {
            return new JsonResponse(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse($postDto, Response::HTTP_OK);
    }
}
