<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        //Admin
        $User = new Users();
        $User->setName("Toto");
        $User->setEmail("Toto@test.com");
        $User->setRoles( array_unique( ['ROLE_ADMIN']) );
        $User->setFirstName("Toto");
        $password = $this->passwordEncoder->encodePassword($User, 'admin');
        $User->setPassword($password);        
        $manager->persist($User);
        $manager->flush();

        //User
        $User = new Users();
        $User->setName("Toto");
        $User->setEmail("Test@test.com");
        $User->setRoles( array_unique( ['ROLE_USER']) );
        $User->setFirstName("Toto");
        $password = $this->passwordEncoder->encodePassword($User, 'admin');
        $User->setPassword($password);        
        $manager->persist($User);
        $manager->flush();
    }
}
