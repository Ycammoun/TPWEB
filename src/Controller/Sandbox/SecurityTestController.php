<?php

namespace App\Controller\Sandbox;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/sandbox/securitytest', name: 'sandbox_securitytest')]
final class SecurityTestController extends AbstractController
{
    #[Route('/addusers', name: '_addusers')]
    public function addUsersAction(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user1=new User();
        $user1
            ->setRoles(['ROLE_CLIENT'])
            ->setLogin('jarod')
            ->setName('Le Cam´el´eon’');
        $hachedpassword1=$passwordHasher->hashPassword($user1,'toto');
        $user1->setPassword($hachedpassword1);
        $em->persist($user1);

        $user = new User();
        $user
            ->setLogin('parker')
            ->setName('Mlle Parker')
            ->setRoles(['ROLE_SALARIE']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'azerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('sidney')
            ->setName('Sidney')
            ->setRoles(['ROLE_SALARIE', 'ROLE_GESTION']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'password');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('raines')
            ->setName('William Raines')
            ->setRoles(['ROLE_DIRIGEANT']);
        $hashedPassword = $passwordHasher->hashPassword($user, '123456');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $user = new User();
        $user
            ->setLogin('angelo')
            ->setName('Angelo')
            ->setRoles(['ROLE_GESTION']);
        $hashedPassword = $passwordHasher->hashPassword($user, 'qwerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);

        $em->flush();
        return new Response('<body>4users added</body>');


    }
}
