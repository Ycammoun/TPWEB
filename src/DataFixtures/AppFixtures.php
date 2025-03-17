<?php

namespace App\DataFixtures;

use App\Entity\Manuel;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $em): void
    {
        $manuel2 = new Manuel();
        $manuel2
            ->setUrl('https://www.lelivrescolaire.fr/')
            ->setSommaire('I titre; II pas titre');
        $em->persist($manuel2);

        $produit2 = new Produit();
        $produit2
            ->setDenomination('skate')
            ->setCode('5 21 749 559')
            // on n'initialise pas DateCreation car le constructeur le fait
            ->setActif(true)
            ->setDescriptif('descriptif 22222')
            ->setManuel($manuel2);
        $em->persist($produit2);



        $em->flush();
    }
}
