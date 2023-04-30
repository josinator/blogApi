<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Blog\Application\Query\GetAuthorByIdQuery;
use Common\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAuthorController extends AbstractController
{
    #[Route('/author/{id}', name: 'api_author_detail', methods: ['GET'])]
    public function index(
        QueryBus $queryBus,
        int $id
    ): JsonResponse {
        try {
            $authorDto = $queryBus->handle(new GetAuthorByIdQuery($id));
        } catch (\Exception $e) {
            return new JsonResponse(json_encode(['message' => $e->getMessage()]), Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $th) {
            return new JsonResponse(json_encode(['message' => $th->getMessage()]), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse(json_encode($authorDto), Response::HTTP_OK);
    }
}
