<?php

declare(strict_types=1);

namespace App\Api;

use Blog\Application\Command\CreatePostCommand;
use Blog\Application\DTO\PostDetailDto;
use Common\Application\CommandBus;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class AddPostController extends AbstractController
{
    #[Route('/post/add', name: 'api_post_add', methods: ['POST'])]
    public function index(
        Request $request,
        CommandBus $commandBus
    ): JsonResponse
    {
        $data = $request->getContent();
        if(!$data){
            return new JsonResponse(['message' => "No data"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try{
            $post = json_decode($data, true);
            /** @var Envelope $envelope */
            $envelope = $commandBus->handle(new CreatePostCommand($post));
            /** @var PostDetailDto $post */
            $post = $envelope->last(HandledStamp::class)->getResult();
            return new JsonResponse($post, Response::HTTP_OK);
        }catch (Exception $e){
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }catch (Throwable $th){
            return new JsonResponse(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }
}
