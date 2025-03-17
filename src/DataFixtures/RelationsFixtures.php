<?php

namespace App\DataFixtures;
use App\Entity\Relations\Etablissement;
use APP\Entity\Relations\HabitantEtablissement;
use App\Entity\Relations\Habitant;
use App\Entity\Relations\Nationalite;
use App\Entity\Relations\Permis;
use App\Entity\Relations\Ville;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class RelationsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nationaliteFR=new Nationalite();
        $nationaliteFR
            ->setNom('France');

        $manager->persist($nationaliteFR);
        $nationaliteUS=new Nationalite();
        $nationaliteUS
            ->setNom('USA');
        $manager->persist($nationaliteUS);
        $nationaliteCA=new Nationalite();
        $nationaliteCA
            ->setNom('Canada');
        $manager->persist($nationaliteCA);
        /*--------------------------------------------------------------*
         | villes
        *--------------------------------------------------------------*/

        $ville1=new Ville();
        $ville1
            ->setNom('paris');
        $manager->persist($ville1);

        $ville2=new Ville();
        $ville2
            ->setNom('poitiers');
        $manager->persist($ville2);

        $ville3=new Ville();
        $ville3
            ->setNom('lille');
        $manager->persist($ville3);

        /*--------------------------------------------------------------*
        | établissements
        *--------------------------------------------------------------*/
        $etablissement1 = new Etablissement();
        $etablissement1->setNom('Université Poitiers');
        $manager->persist($etablissement1);

        $etablissement2 = new Etablissement();
        $etablissement2->setNom('Université Limoges');
        $manager->persist($etablissement2);

        $manager->flush();


        /*--------------------------------------------------------------*
         | permis
        *--------------------------------------------------------------*/
        $permis1=new Permis();
        $permis1
            ->setPrefecture('vienne');

        /*--------------------------------------------------------------*
        | habitant
        *--------------------------------------------------------------*/
        $habitant=new Habitant();
        $habitant
            ->setNom('Dupont')
            ->setPermis($permis1)
            ->setVille($ville1)
            ->addNationalite($nationaliteFR);

        $manager->persist($habitant);
        foreach ([1958, 1959, 1960, 1961] as $annee)
        {
            $tmp = new HabitantEtablissement();
            $tmp
                ->setHabitant($habitant)
                ->setEtablissement($etablissement1)
                ->setAnnee($annee)
            ;
            $manager->persist($tmp);
        }


        $permis2 = new Permis();
        $permis2->setPrefecture('paris');

        $habitant2 = new Habitant();
        $habitant2
            ->setNom('yassine')
            ->setPermis($permis2)
            ->setVille($ville2)
            ->addNationalite($nationaliteUS);
        $manager->persist($habitant2);
        foreach ([2000, 2001] as $annee)
        {
            $tmp = new HabitantEtablissement();
            $tmp
                ->setHabitant($habitant2)
                ->setEtablissement($etablissement1)
                ->setAnnee($annee)
            ;
            $manager->persist($tmp);
        }
        foreach ([2000] as $annee)
        {
            $tmp = new HabitantEtablissement();
            $tmp
                ->setHabitant($habitant2)
                ->setEtablissement($etablissement2)
                ->setAnnee($annee)
            ;
            $manager->persist($tmp);
        }



        $permis3 = new Permis();
        $permis3->setPrefecture('lille');
        $habitant3 = new Habitant();
        $habitant3
            ->setNom('kammoun')
            ->setPermis($permis3)
            ->setVille($ville3)
            ->addNationalite($nationaliteCA);
        $manager->persist($habitant3);

        $habitant4 = new Habitant();
        $habitant4
            ->setNom('km')
            ->setPermis(null)
            ->setVille($ville3)
            ->addNationalite($nationaliteCA);
        $nationaliteCA->addHabitant($habitant4);
        $manager->persist($habitant4);

        $permis5 = new Permis();
        $permis5->setPrefecture('bordeaux');
        $habitant5 = new Habitant();
        $habitant5
            ->setNom('sebastien')
            ->setPermis($permis5)
            ->setVille($ville3)
            ->addNationalite($nationaliteFR);
        $nationaliteFR->addHabitant($habitant5);
        $nationaliteCA->addHabitant($habitant5);

        $manager->persist($habitant5);





        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
