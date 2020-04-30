<?php

namespace App\DataFixtures;

use App\Entity\States;
use App\Entity\Actions;
use App\Entity\Projects;
use App\Entity\Customers;
use App\Entity\Attributes;
use App\Entity\Conditions;
use App\Entity\Equipments;
use App\Entity\TypeEquipments;
use App\Entity\TypeStates;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

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
        $project = new Projects();
        $project->setName("Alpha");
        $project->setDescription("Lorem Ipsum");
        $project->getCustomers(1);
        $project->getEquipments(1);
        $manager->persist($project);
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
        $TypeEquipment1 = new TypeEquipments();
        $TypeEquipment1->setTitle("vanne");
        $TypeEquipment1->setDescription("Vanne");
        $manager->persist($TypeEquipment1);
        $manager->flush();

        $TypeEquipment2 = new TypeEquipments();
        $TypeEquipment2->setTitle("Pompe");
        $TypeEquipment2->setDescription("Pompe");
        $manager->persist($TypeEquipment2);
        $manager->flush();

        $TypeEquipment3 = new TypeEquipments();
        $TypeEquipment3->setTitle("purge");
        $TypeEquipment3->setDescription("Purge");
        $manager->persist($TypeEquipment3);
        $manager->flush();


        // Fixtures type d'équipements
        $equipment1 = new Equipments();
        $equipment1->setProject($project);
        $equipment1->setName("Vanne entrée");
        $equipment1->setInit("closed");
        $equipment1->setTypeequipment($TypeEquipment1);
        $manager->persist($equipment1);
        $manager->flush();
        $equipment2 = new Equipments();
        $equipment2->setProject($project);
        $equipment2->setName("Vanne sortie");
        $equipment2->setInit("closed");
        $equipment2->setTypeequipment($TypeEquipment1);
        $manager->persist($equipment2);
        $manager->flush();
        $equipment3 = new Equipments();
        $equipment3->setProject($project);
        $equipment3->setName("Pompe DMSM");
        $equipment3->setInit("closed");
        $equipment3->setTypeequipment($TypeEquipment2);
        $manager->persist($equipment3);
        $manager->flush();
        $equipment4 = new Equipments();
        $equipment4->setProject($project);
        $equipment4->setName("Purge haute");
        $equipment4->setInit("closed");
        $equipment4->setTypeequipment($TypeEquipment3);
        $manager->persist($equipment4);
        $manager->flush();
        $equipment5 = new Equipments();
        $equipment5->setProject($project);
        $equipment5->setName("Purge basse");
        $equipment5->setInit("closed");
        $equipment5->setTypeequipment($TypeEquipment3);
        $manager->persist($equipment5);
        $manager->flush();

        // Fixtures type de status
        $typeStatut1 = new TypeStates();
        $typeStatut1->setName("closed");
        $manager->persist($typeStatut1);
        $manager->flush();
        $typeStatut2 = new TypeStates();
        $typeStatut2->setName("open");
        $manager->persist($typeStatut2);
        $manager->flush();
        
        //Fixtures States
        $status1 = new States();
        $status1->setName("closed");
        $status1->setDescription("statut closed ");
        $status1->setEquipment($equipment1);
        $status1->setTypestate($typeStatut1);
        $status1->setGroupe(1);
        $manager->persist($status1);
        $manager->flush();
        $status2 = new States();
        $status2->setName("closed");
        $status2->setDescription("statut closed ");
        $status2->setEquipment($equipment2);
        $status2->setTypestate($typeStatut2);
        $status2->setGroupe(1);
        $manager->persist($status2);
        $manager->flush();
        $status3 = new States();
        $status3->setName("closed");
        $status3->setDescription("statut closed ");
        $status3->setEquipment($equipment3);
        $status3->setTypestate($typeStatut2);
        $status3->setGroupe(1);
        $manager->persist($status3);
        $manager->flush();
        $status4 = new States();
        $status4->setName("closed");
        $status4->setDescription("statut closed ");
        $status4->setEquipment($equipment4);
        $status4->setTypestate($typeStatut2);
        $status4->setGroupe(1);
        $manager->persist($status4);
        $manager->flush();
        $status5 = new States();
        $status5->setName("closed");
        $status5->setDescription("statut closed ");
        $status5->setEquipment($equipment5);
        $status5->setTypestate($typeStatut2);
        $status5->setGroupe(1);
        $manager->persist($status5);
        $manager->flush();       
    }
}
