<?php

namespace App\Controller;

use App\Entity\Conditions;
use App\Form\ConditionsType;
use App\Repository\ConditionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/conditions")
 * @IsGranted("ROLE_ADMIN")
 */
class ConditionsController extends AbstractController
{
    /**
     * @Route("/", name="conditions_index", methods={"GET"})
     */
    public function index(ConditionsRepository $conditionsRepository): Response
    {
        return $this->render('conditions/index.html.twig', [
            'conditions' => $conditionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="conditions_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $condition = new Conditions();
        $form = $this->createForm(ConditionsType::class, $condition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($condition);
            $entityManager->flush();

            return $this->redirectToRoute('conditions_index');
        }

        return $this->render('conditions/new.html.twig', [
            'condition' => $condition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conditions_show", methods={"GET"})
     */
    public function show(Conditions $condition): Response
    {
        return $this->render('conditions/show.html.twig', [
            'condition' => $condition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="conditions_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conditions $condition): Response
    {
        $form = $this->createForm(ConditionsType::class, $condition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conditions_index');
        }

        return $this->render('conditions/edit.html.twig', [
            'condition' => $condition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conditions_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Conditions $condition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$condition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($condition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conditions_index');
    }
}
