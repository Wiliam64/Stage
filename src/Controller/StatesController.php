<?php

namespace App\Controller;

use App\Entity\States;
use App\Form\StatesType;
use App\Repository\StatesRepository;
use App\Repository\ProjectsRepository;
use App\Repository\EquipmentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/states")
 */
class StatesController extends AbstractController
{
    
    /**
     * @Route("/new/{projetid}", name="states_new", methods={"GET","POST"})
     */
    public function new($projetid, Request $request, ProjectsRepository $projectsRepository, 
                        EquipmentsRepository $equipmentsRepository, StatesRepository $StatesRepository): Response
    {
        $projet = $projectsRepository->find($projetid);
        $state = new States();
        $form = $this->createForm(StatesType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //enregistre un status pour chaque equipement
            $equipments = $equipmentsRepository->findByProject($projet->getId());
            $groupe = $StatesRepository->findMaxGroup($projetid);

            $entityManager = $this->getDoctrine()->getManager();
            foreach($equipments as $equipment) {

                $stateEq = new States();
                $stateEq->setName( $state->getName() );
                $stateEq->setDescription( $state->getDescription() );
                $stateEq->setTypestate( $state->getTypestate() );
                $stateEq->setEquipment( $equipment );
                $stateEq->setGroupe( $groupe );
                $entityManager->persist($stateEq);
                $entityManager->flush();
            }

            return $this->redirectToRoute('projects_show', ["id" => $projetid]);
        }

        return $this->render('states/new.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
            'projet' =>  $projectsRepository->find($projetid),
        ]);
    }

    /**
     * @Route("/{id}/{projetid}", name="states_show", methods={"GET"})
     */
    public function show($projetid, States $state, ProjectsRepository $projectsRepository): Response
    {
        return $this->render('states/show.html.twig', [
            'state' => $state,
            'projet' => $projectsRepository->find($projetid),
        ]);
    }

    /**
     * @Route("/{id}/edit/{projetid}", name="states_edit", methods={"GET","POST"})
     */
    public function edit($projetid, Request $request, States $state, ProjectsRepository $projectsRepository): Response
    {
        $form = $this->createForm(StatesType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projects_show', ["id" => $projetid]);
        }

        return $this->render('states/edit.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
            'projet' => $projectsRepository->find($projetid),
        ]);
    }

    /**
     * @Route("/{id}/{projetid}", name="states_delete", methods={"DELETE"})
     */
    public function delete($projetid, Request $request, States $state): Response
    {
        if ($this->isCsrfTokenValid('delete'.$state->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($state);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projects_show', ["id" => $projetid]);
    }

    /**
     * @Route("/exportjson/{id}/{projetid}", name="export_json", methods={"GET", "POST"})
     */
    public function exportJson($projetid, States $state, EquipmentsRepository $equipmentsRepository)
    {
        $equipements = $equipmentsRepository->findByGroup($projetid, $state->getGroupe());
       
        return $this->json($equipements,200,[],['groups'=>'get:read']);
    }
}
