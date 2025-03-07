<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox/twig', name: 'sandbox_twig')]
class TwigController extends AbstractController
{
    #[Route(
        '/vue1',
        name: '_vue1',
    )]
    public function vue1Action(): Response
    {
        return $this->render('Sandbox/Twig/vue1.html.twig');
    }
    #[Route(
        '/vue2',
        name: '_vue2',
    )]
    public function vue2Action(): Response
    {
        return $this->render('Sandbox/Twig/vue2.html.twig');
    }
    #[Route(
        '/vue3',
        name: '_vue3',
    )]
    public function vue3Action(): Response
    {
        return $this->render('Sandbox/Twig/vue3.html.twig');
    }
    #[Route(
        '/vue4',
        name: '_vue4',
    )]
    public function vue4Action():Response
    {
        return $this->render('Sandbox/Twig/vue4.html.twig');
    }

}
