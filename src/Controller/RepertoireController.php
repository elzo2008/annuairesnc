<?php

namespace App\Controller;

use App\Entity\Repertoire;
use App\Form\RepertoireType;
use App\Repository\RepertoireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/repertoire")
 */
class RepertoireController extends AbstractController
{
    /**
     * @Route("/", name="app_repertoire_index", methods={"GET"})
     */
    public function index(RepertoireRepository $repertoireRepository): Response
    {
        return $this->render('repertoire/index.html.twig', [
            'repertoires' => $repertoireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_repertoire_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RepertoireRepository $repertoireRepository): Response
    {
        $repertoire = new Repertoire();
        $form = $this->createForm(RepertoireType::class, $repertoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repertoireRepository->add($repertoire);
            return $this->redirectToRoute('app_repertoire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('repertoire/new.html.twig', [
            'repertoire' => $repertoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_repertoire_show", methods={"GET"})
     */
    public function show(Repertoire $repertoire): Response
    {
        return $this->render('repertoire/show.html.twig', [
            'repertoire' => $repertoire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_repertoire_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Repertoire $repertoire, RepertoireRepository $repertoireRepository): Response
    {
        $form = $this->createForm(RepertoireType::class, $repertoire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repertoireRepository->add($repertoire);
            return $this->redirectToRoute('app_repertoire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('repertoire/edit.html.twig', [
            'repertoire' => $repertoire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_repertoire_delete", methods={"POST"})
     */
    public function delete(Request $request, Repertoire $repertoire, RepertoireRepository $repertoireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repertoire->getId(), $request->request->get('_token'))) {
            $repertoireRepository->remove($repertoire);
        }

        return $this->redirectToRoute('app_repertoire_index', [], Response::HTTP_SEE_OTHER);
    }
}
