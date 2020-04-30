<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        //pour récupérer l'user courant
        //$user = $this->getUser();
        
        return $this->render('main/index.html.twig', []);
    }
}
