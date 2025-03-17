<?php

namespace App\Controller;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/produit', name: 'produit')]
class ProduitController extends AbstractController
{
    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return $this->redirectToRoute('produit_list', ['page' => 1]);
    }

    #[Route(
        '/list/{page}',
        name: '_list',
        requirements: ['page' => '[1-9]\d*'],
        defaults: [ 'page' => 0],        // la valeur par défaut ne respecte pas les contraintes
    )]
    public function listAction(int $page,EntityManagerInterface $em): Response
    {
        $produits = $em->getRepository(Produit::class)->findAll();


        $args = array(
            'page' => $page,
            'produits' => $produits


        );
        return $this->render('Produit/list.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function viewAction(int $id , EntityManagerInterface $em): Response
    {
        $produit = $em->getRepository(Produit::class)->find($id);
        if (is_null($produit)) {
            $this->addFlash('info', 'produit ' . $id . ' inexistant');
            $this->redirectToRoute('produit_list');
        }

        // simule l'interrogation de la base avec $id
        $args = array(
            'produit' => $produit
        );
        return $this->render('Produit/view.html.twig', $args);
    }

    #[Route(
        '/add',
        name: '_add',
    )]
    public function addAction(): Response
    {
        $this->addFlash('info', 'échec ajout produit');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route(
        '/edit/{id}',
        name: '_edit',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function editAction(int $id): Response
    {
        $this->addFlash('info', 'échec modification produit ' . $id);
        return $this->redirectToRoute('produit_view', ['id' => $id]);
    }

    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id,EntityManagerInterface $em): Response
    {
        $produit = $em->getRepository(Produit::class)->find($id);
        if (is_null($produit)) {
            $this->addFlash('info', 'produit ' . $id . ' inexistant');
            throw $this->createNotFoundException('Produit ' . $id . ' inexistant');
        }
        $em->remove($produit);
        $em->flush();

        $this->addFlash('info', 'échec suppression produit ' . $id);
        return $this->redirectToRoute('produit_list');
    }

    #[Route(
        '/pays/add',
        name: '_pays_add',
    )]
    public function paysAddAction(): Response
    {
        $this->addFlash('info', 'échec ajout relation produit/pays');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

    #[Route(
        '/magasin/add',
        name: '_magasin_add',
    )]
    public function magasinAddAction(): Response
    {
        $this->addFlash('info', 'échec ajout relation produit/magasin');
        return $this->redirectToRoute('produit_view', ['id' => 3]);
    }

}
