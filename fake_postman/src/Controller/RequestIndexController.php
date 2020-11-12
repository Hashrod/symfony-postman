<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RequestIndexController extends AbstractController
{
    /**
     * @Route("/request/index", name="request_index")
     */
    public function index(): Response
    {
        return $this->render('request_index/index.html.twig', [
            'controller_name' => 'RequestIndexController',
        ]);
    }
}
