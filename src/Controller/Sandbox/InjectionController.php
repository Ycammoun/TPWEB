<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\Session;

#[Route('/sandbox/injection', name: 'sandbox_injection')]
class InjectionController extends AbstractController
{
    #[Route('/un', name: '_un')]
    public function unAction(Request $request):Response
    {
        dump($request->cookies->all()) ;
        dump($request->query->get('foo'));
        dump($request->query->all());

        dump($request->getMethod());
        //dump($request);

        return new Response('<body> Injection : un </body>');
    }
    #[Route('/deux', name: '_deux')]
    public function deuxAction(Request $request, Session $session): Response
    {
        if ($request->query->has('compteur'))
            $session->set('compteur', $request->query->get('compteur'));
        elseif (! is_null($request->query->get('inc')))
            $session->set('compteur', $session->get('compteur') + 1);
        elseif ($request->query->get('supp') !== null)
            $session->remove('compteur');

        dump($session->all());
        dump($_SESSION);

        return new Response('<body>Injection::deux</body>');
    }
    #[Route('/create_flash', name: '_create_flash')]
    public function createFlashAction(Session $session):Response
    {
        $session->getFlashBag()->add('info','Lenregistrement a ete supprimé');
        $this->addFlash('info','Lenregistrement a ete supprimé');
        $session->getFlashBag()->add('error','erreur');
        $this->addFlash('error','erreur');
        return $this->redirectionToRoute('sandbox_injection_display_flash');
    }
    #[Route('/display-flash', name: '_display_flash')]
    public function displayFlashAction(): Response
    {
        return $this->render('Sandbox/Injection/displayFlash.html.twig');
    }




}
