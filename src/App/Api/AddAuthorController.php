<?php

declare(strict_types=1);

namespace App\Api;

use Blog\Application\Command\CreateAuthorCommand;
use Blog\Application\DTO\AuthorDetailDto;
use Common\Application\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class AddAuthorController extends AbstractController
{
    #[Route('/author/add', name: 'api_author_add', methods: ['POST'])]
    public function index(
        Request $request,
        CommandBus $commandBus
    ): JsonResponse {
        $data = $request->getContent();
        if (!$data) {
            return new JsonResponse(['message' => 'No data'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $post = json_decode($data, true);
            /** @var Envelope $envelope */
            $envelope = $commandBus->handle(new CreateAuthorCommand($post));
            /** @var AuthorDetailDto $post */
            $author = $envelope->last(HandledStamp::class)->getResult();

            return new JsonResponse($author, Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $th) {
            return new JsonResponse(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
