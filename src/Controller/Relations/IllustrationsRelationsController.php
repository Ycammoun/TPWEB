<?php

namespace App\Controller\Relations;
use App\Entity\Relations\HabitantEtablissement;

use App\Entity\Relations\Habitant;
use App\Entity\Relations\Nationalite;
use App\Entity\Relations\Permis;
use App\Entity\Relations\Ville;
use App\Repository\Relations\HabitantRepository;
use App\Repository\Relations\PermisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IllustrationsRelationsController extends AbstractController
{
    #[Route('/relations/illustrations/relations', name: 'app_relations_illustrations_relations')]
    public function index(EntityManagerInterface $em): Response
    {
        //$habitantEtablissementRepository = $em->getRepository(HabitantEtablissement::class);

        $nationaliteRepository=$em->getRepository(Nationalite::class);
        $villeRepository=$em->getRepository(Ville::class);
        $permisRepository=$em->getRepository(Habitant::class);
        $habitantRepository=$em->getRepository(Permis::class);
        $permiss = $permisRepository->findAll();
        dump($permiss);
        $habitants = $habitantRepository->findAll();
        dump($habitants);
        $villes = $villeRepository->findAll();
        dump($villes);
        $nationalites = $nationaliteRepository->findAll();
        dump($nationalites);
        //$habitantEtablissements = $habitantEtablissementRepository->findAll();
        //dump($habitantEtablissements);





        return new Response('<body>Regarder les dumps</body>');


    }

}
