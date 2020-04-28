<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\TypeEquipments;
use App\Entity\Customers;
use App\Entity\Projects;
use App\Entity\Actions;
use App\Entity\Conditions;
use App\Entity\Attributes;
use App\Entity\States;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Fixtures Clients
        $Customers = new Customers();
        $Customers->setName("Client 1");
        $Customers->setCompany("Simplon");
        $manager->persist($Customers);
        $manager->flush();
        
        //Fixtures Projets
        $Projects = new Projects();
        $Projects->setName("Alpha");
        $Projects->setDescription("Lorem Ipsum");
        $Projects->getCustomers(1);
        $Projects->getEquipments(1);
        $manager->persist($Projects);
        $manager->flush();

        //Fixtures Actions
        $Actions = new Actions();
        $Actions->setKeyAction("ouvrir");
        $Actions->setValue("ouvre la vanne");
        $manager->persist($Actions);
        $manager->flush();

        //Fixtures Conditions
        $Conditions = new Conditions();
        $Conditions->setKeyCondition("conditions");
        $Conditions->setValue("si...alors");
        $manager->persist($Conditions);
        $manager->flush();
        
        //Fixtures Attributes
        $Attributes = new Attributes();
        $Attributes->setKeyAttribute("couleur");
        $Attributes->setValue("bleue");
        $manager->persist($Attributes);
        $manager->flush();
        
        // Fixtures type d'équipements
        $TypeEquipment = new TypeEquipments();
        $TypeEquipment->setTitle("1 type");
        $TypeEquipment->setDescription("Lorem Ipsum");
        $TypeEquipment->setStates(null);
        $manager->persist($TypeEquipment);
        $manager->flush();
        
        //Fixtures States
        $States = new States();
        $States->setName("State 1");
        $States->setDescription("Description du state 1 ");
        $States->getActions(1);
        $States->getConditions(1);
        $States->getAttributes(1);
        $manager->persist($States);
        $manager->flush();
    }
}
