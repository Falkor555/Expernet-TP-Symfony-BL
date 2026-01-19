<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création de l'utilisateur admin
        $adminUser = new Utilisateur();
        $adminUser->setNom('Botsy');
        $adminUser->setPrenom('Loïc');
        $adminUser->setAdresseMail('loic.botsy@hotmail.com');
        $adminUser->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword($adminUser, 'adminpassword');
        $adminUser->setPassword($hashedPassword);
        $adminUser->setPhoneNumber('0693535054');
        $manager->persist($adminUser);

        $manager->flush();
    }
}