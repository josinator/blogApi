<?php

declare(strict_types=1);

namespace App\Controller;

use Blog\Application\Query\GetPostByIdQuery;
use Common\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAuthorDetailController extends AbstractController
{
    #[Route('/author/{id}', name: 'app_get_author_detail')]
    public function index(
        int $id,
        QueryBus $queryBus
    ): Response {

        $post = $queryBus->handle(new GetPostByIdQuery($id));

        return $this->render('get_post_detail/index.html.twig', [
            'controller_name' => 'GetPostDetailController',
        ]);
    }
}
