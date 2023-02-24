<?php

namespace App\Controller;

use App\Entity\InventaireMateriel;
use App\Form\InventaireMaterielType;
use App\Repository\InventaireMaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inventaire/materiel")
 */
class InventaireMaterielController extends AbstractController
{
    /**
     * @Route("/", name="app_inventaire_materiel_index", methods={"GET"})
     */
    public function index(InventaireMaterielRepository $inventaireMaterielRepository): Response
    {
        return $this->render('inventaire_materiel/index.html.twig', [
            'inventaire_materiels' => $inventaireMaterielRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_inventaire_materiel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InventaireMaterielRepository $inventaireMaterielRepository): Response
    {
        $inventaireMateriel = new InventaireMateriel();
        $form = $this->createForm(InventaireMaterielType::class, $inventaireMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inventaireMaterielRepository->add($inventaireMateriel);
            return $this->redirectToRoute('app_inventaire_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inventaire_materiel/new.html.twig', [
            'inventaire_materiel' => $inventaireMateriel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_inventaire_materiel_show", methods={"GET"})
     */
    public function show(InventaireMateriel $inventaireMateriel): Response
    {
        return $this->render('inventaire_materiel/show.html.twig', [
            'inventaire_materiel' => $inventaireMateriel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_inventaire_materiel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, InventaireMateriel $inventaireMateriel, InventaireMaterielRepository $inventaireMaterielRepository): Response
    {
        $form = $this->createForm(InventaireMaterielType::class, $inventaireMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inventaireMaterielRepository->add($inventaireMateriel);
            return $this->redirectToRoute('app_inventaire_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('inventaire_materiel/edit.html.twig', [
            'inventaire_materiel' => $inventaireMateriel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_inventaire_materiel_delete", methods={"POST"})
     */
    public function delete(Request $request, InventaireMateriel $inventaireMateriel, InventaireMaterielRepository $inventaireMaterielRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inventaireMateriel->getId(), $request->request->get('_token'))) {
            $inventaireMaterielRepository->remove($inventaireMateriel);
        }

        return $this->redirectToRoute('app_inventaire_materiel_index', [], Response::HTTP_SEE_OTHER);
    }
}
