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

    public function palmaresAction(int $n):Response
    {
        

        $produits=[];
        for( $i=0;$i<$n;$i++)
            $produits[]=['denomination' => 'produit'.$i, 'prix'=> 1000-$i];
        
        return $this->render('Sandbox/Layouts/_palmares.html.twig' ,  [ 'produits' => $produits ]);
    }





    #[Route(
        '/vue5',
        name: '_vue5',
    )]
    public function vue5Action():Response
    {
        return $this->render('Sandbox/Layouts/layout3.html.twig');
    }


}
