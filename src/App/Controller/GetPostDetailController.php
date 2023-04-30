<?php

declare(strict_types=1);

namespace App\Controller;

use Blog\Application\DTO\PostDetailDto;
use Blog\Application\Query\GetPostByIdQuery;
use Common\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostDetailController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_get_post_detail')]
    public function index(
        int $id,
        QueryBus $queryBus
    ): Response {

        /** @var PostDetailDto $postDto */
        $postDto = $queryBus->handle(new GetPostByIdQuery($id));

        return $this->render('get_post_detail/index.html.twig', [
            'post' => $postDto,
        ]);
    }
}
