<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox/route', name: 'sandbox_route')]
class RouteController extends AbstractController
{
    #[Route(
        '/with-variable/{age}',
        name: '_with_variable'
    )]
    public function withVariableAction($age): Response
    {
        return new Response('<body>Route::withVariable : age = ' . $age . '</body>');
    }

    #[Route(
        '/with-default/{age}',
        name: '_with_default',
        defaults: ['age' => 18],
    )]
    public function withDefaultAction($age): Response
    {
        dump($age);
        return new Response('<body>Route::withDefault : age = ' . $age . ' (' . gettype($age) . ')</body>');
    }
    #[Route(
        '/with-constraint/{age}',
        name: '_with_constraint',
        requirements: ['age' => '0|[1-9]\d*'],
        defaults: ['age' => 18],
    )]
    public function withConstraintAction($age): Response
    {
        dump($age);
        return new Response('<body>Route::withConstraint : age = ' . $age . ' (' . gettype($age) . ')</body>');
    }
    #[Route(
        '/test1/{year}/{month}/{filename}.{ext}',
        name: '_test1',

    )]
    public function test1($year,$month,$filename,$ext): Response
    {
        $args = array(
            'title'=> 'test1',
            'year' => $year,
            'month' => $month,
            'filename' =>$filename,
            'ext'=> $ext,
        );
        return $this->render('Sandbox/Route/test1234.html.twig', $args);
                    
    }
    #[Route(
        '/test2/{year}/{month}/{filename}.{ext}',
        name: '_test2',
        requirements: [
            'year' => '[1-9]\d{0,3}',
            'month' => '0?[1-9]|(1[0-2])',
            'filename'=> '[-a-zA-Z]+',
            'ext'=>'jpg|jpeg|png|ppm',
        ]

    )]
    public function test2(int $year,int $month, string $filename,string $ext): Response
    {
        $args = array(
            'title'=> 'test1',
            'year' => $year,
            'month' => $month,
            'filename' =>$filename,
            'ext'=> $ext,
        );
        return $this->render('Sandbox/Route/test1234.html.twig', $args);
                    
    }

}
