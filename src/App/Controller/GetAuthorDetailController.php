<?php

declare(strict_types=1);

namespace App\Controller;

use Blog\Application\Query\GetAuthorByIdQuery;
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

        $authorDto = $queryBus->handle(new GetAuthorByIdQuery($id));

        return $this->render('author/detail.html.twig', [
            'author' => $authorDto
        ]);
    }
}
