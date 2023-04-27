<?php

declare(strict_types=1);

namespace App\Controller;

use Blog\Application\Query\GetAllPostQuery;
use Common\Application\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetPostListController extends AbstractController
{
    #[Route('/', name: 'app_get_post_list')]
    public function index(
        QueryBus $queryBus
    ): Response {

        $postItems = $queryBus->handle(new GetAllPostQuery());

        return $this->render('get_post_list/index.html.twig', [
            'controller_name' => 'GetPostListController',
            'postItems' => $postItems,
        ]);
    }
}
