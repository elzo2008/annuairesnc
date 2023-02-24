<?php

namespace App\Controller;

use App\Entity\Cartouche;
use App\Form\CartoucheType;
use App\Repository\CartoucheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cartouche")
 */
class CartoucheController extends AbstractController
{
    /**
     * @Route("/", name="app_cartouche_index", methods={"GET"})
     */
    public function index(CartoucheRepository $cartoucheRepository): Response
    {
        return $this->render('cartouche/index.html.twig', [
            'cartouches' => $cartoucheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cartouche_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CartoucheRepository $cartoucheRepository): Response
    {
        $cartouche = new Cartouche();
        $form = $this->createForm(CartoucheType::class, $cartouche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartoucheRepository->add($cartouche);
            return $this->redirectToRoute('app_cartouche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cartouche/new.html.twig', [
            'cartouche' => $cartouche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cartouche_show", methods={"GET"})
     */
    public function show(Cartouche $cartouche): Response
    {
        return $this->render('cartouche/show.html.twig', [
            'cartouche' => $cartouche,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cartouche_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cartouche $cartouche, CartoucheRepository $cartoucheRepository): Response
    {
        $form = $this->createForm(CartoucheType::class, $cartouche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cartoucheRepository->add($cartouche);
            return $this->redirectToRoute('app_cartouche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cartouche/edit.html.twig', [
            'cartouche' => $cartouche,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_cartouche_delete", methods={"POST"})
     */
    public function delete(Request $request, Cartouche $cartouche, CartoucheRepository $cartoucheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cartouche->getId(), $request->request->get('_token'))) {
            $cartoucheRepository->remove($cartouche);
        }

        return $this->redirectToRoute('app_cartouche_index', [], Response::HTTP_SEE_OTHER);
    }
}
