<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAPIPostController extends AbstractController
{
    #[Route('/get/a/p/i/post', name: 'app_get_a_p_i_post')]
    public function index(): Response
    {
        return $this->render('get_api_post/index.html.twig', [
            'controller_name' => 'GetAPIPostController',
        ]);
    }
}
