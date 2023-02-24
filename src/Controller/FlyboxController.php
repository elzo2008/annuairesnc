<?php

namespace App\Controller;

use App\Entity\Flybox;
use App\Form\FlyboxType;
use App\Repository\FlyboxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flybox")
 */
class FlyboxController extends AbstractController
{
    /**
     * @Route("/", name="app_flybox_index", methods={"GET"})
     */
    public function index(FlyboxRepository $flyboxRepository): Response
    {
        return $this->render('flybox/index.html.twig', [
            'flyboxes' => $flyboxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_flybox_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FlyboxRepository $flyboxRepository): Response
    {
        $flybox = new Flybox();
        $form = $this->createForm(FlyboxType::class, $flybox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flyboxRepository->add($flybox);
            return $this->redirectToRoute('app_flybox_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('flybox/new.html.twig', [
            'flybox' => $flybox,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_flybox_show", methods={"GET"})
     */
    public function show(Flybox $flybox): Response
    {
        return $this->render('flybox/show.html.twig', [
            'flybox' => $flybox,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_flybox_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Flybox $flybox, FlyboxRepository $flyboxRepository): Response
    {
        $form = $this->createForm(FlyboxType::class, $flybox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flyboxRepository->add($flybox);
            return $this->redirectToRoute('app_flybox_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('flybox/edit.html.twig', [
            'flybox' => $flybox,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_flybox_delete", methods={"POST"})
     */
    public function delete(Request $request, Flybox $flybox, FlyboxRepository $flyboxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flybox->getId(), $request->request->get('_token'))) {
            $flyboxRepository->remove($flybox);
        }

        return $this->redirectToRoute('app_flybox_index', [], Response::HTTP_SEE_OTHER);
    }
}
