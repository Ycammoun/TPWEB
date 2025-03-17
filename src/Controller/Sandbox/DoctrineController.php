<?php

namespace App\Controller\Sandbox;

use App\Entity\Sandbox\Critique;
use App\Entity\Sandbox\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox/doctrine', name: 'sandbox_doctrine')]
class DoctrineController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listAction(EntityManagerInterface $em): Response
    {
        $films = $em->getRepository(Film::class)->findAll();

        $args = array(
            'films' => $films,


        );
        return $this->render('Sandbox/Doctrine/list.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function viewAction(int $id,EntityManagerInterface $em): Response
    {
        $film=$em->getRepository(Film::class)->find($id);
        dump($film);
        $args = array(
            'film' => $film,
            'id' => $id,
        );
        return $this->render('Sandbox/Doctrine/view.html.twig', $args);
    }

    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id,EntityManagerInterface $em): Response
    {
        $film=$em->getRepository(Film::class)->find($id);
        if (is_null($film)) {
            $this->addFlash('info', 'film ' . $id . ' inexistant');
            throw new NotFoundHttpException('Film ' . $id . ' inexistant');
        }
        $em->remove($film);
        $em->flush();

        $this->addFlash('info', 'suppression film ' . $id . ' réussie');
        return $this->redirectToRoute('sandbox_doctrine_list');
    }

    #[Route('/ajouterendur', name: '_ajouterendur')]
    public function ajouterendurAction(EntityManagerInterface $em): Response
    {
        $film = new Film();
        $film
            ->setTitre('Le grand bleu')
            ->setAnnee(1988)
            ->setEnstock(true)
            ->setPrix(9.99)
            ->setQuantite(88);
        dump($film);

        $em->persist($film);
        $em->flush();
        dump($film);

        return $this->redirectToRoute('sandbox_doctrine_view', ['id' => $film->getId()]);
    }
    #[Route('/modifierendur', name: '_modifierendur')]
    public function modifierendurAction(EntityManagerInterface $em): Response
    {
        $film = $em->getRepository(Film::class)->find(1);
        $film

            ->setPrix(19.55)
            ->setQuantite($film->getQuantite() + 10);
        $em->flush();
        return $this->redirectToRoute('sandbox_doctrine_view', ['id' => $film->getId()]);
    }
    #[Route('/effacerendure', name: '_effacerendure')]
    public function effacerendureAction(EntityManagerInterface $em):Response
    {
        $film = $em->getRepository(Film::class)->find(3);
        $em->remove($film);
        $em->flush();
        return $this->redirectToRoute('sandbox_doctrine_list');

    }
    #[Route('/critique/ajouterendur', name: '_critique_ajouterendur')]
    public function critiqueAjouterendurAction(EntityManagerInterface $em): Response
    {
        $film = new Film();
        $film
            ->setTitre('Le grand bleu')
            ->setAnnee(1988)
            ->setEnstock(true)        // inutile : valeur par défaut
            ->setPrix(9.99)
            ->setQuantite(95);
        $em->persist($film);

        $critique1 = new Critique();
        $critique1
            ->setNote(5)
            ->setAvis("sa a changer tout ma vi")
            ->setFilm($film);
        $em->persist($critique1);

        $critique2 = new Critique();
        $critique2
            ->setNote(0)
            ->setAvis("Le grand vide plutôt !")
            ->setFilm($film);
        $em->persist($critique2);

        $em->flush();

        dump($film);

        return $this->redirectToRoute('sandbox_doctrine_critique_view1', ['id' => $film->getId()]);
        //return $this->redirectToRoute('sandbox_doctrine_critique_view2', ['id' => $film->getId()]);
    }
    #[Route(
        '/critique/view1/{id}',
        name: '_critique_view1',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function critiqueView1Action(int $id, EntityManagerInterface $em): Response
    {
        $filmRepository = $em->getRepository(Film::class);
        $critiquesRepository = $em->getRepository(Critique::class);
        $film = $filmRepository->find($id);

        if(is_null($film)) {
            throw new NotFoundHttpException('Film ' . $id . ' inexistant');
        }
        $critiques = $critiquesRepository->findBy(['film' => $film]);

        $args = array(
            'film' => $film,
            'critiques' => $critiques,
        );
        return $this->render('Sandbox/Doctrine/critiqueView1.html.twig', $args);
    }
    #[Route(
        '/critique/view2/{id}',
        name: '_critique_view2',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function critiqueView2Action(int $id, EntityManagerInterface $em): Response
    {
        $filmRepository = $em->getRepository(Film::class);

        $film = $filmRepository->find($id);
        if (is_null($film))
            throw new NotFoundHttpException('Film ' . $id . ' inexistant');

        $args = array(
            'film' => $film,
        );
        return $this->render('Sandbox/Doctrine/critiqueView2.html.twig', $args);
    }
}
