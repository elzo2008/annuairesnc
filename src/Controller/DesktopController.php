<?php

namespace App\Controller;

use App\Entity\Desktop;
use App\Form\DesktopType;
use App\Repository\DesktopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/desktop")
 */
class DesktopController extends AbstractController
{
    /**
     * @Route("/", name="app_desktop_index", methods={"GET"})
     */
    public function index(DesktopRepository $desktopRepository): Response
    {
        return $this->render('desktop/index.html.twig', [
            'desktops' => $desktopRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_desktop_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DesktopRepository $desktopRepository): Response
    {
        $desktop = new Desktop();
        $form = $this->createForm(DesktopType::class, $desktop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $desktopRepository->add($desktop);
            return $this->redirectToRoute('app_desktop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('desktop/new.html.twig', [
            'desktop' => $desktop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_desktop_show", methods={"GET"})
     */
    public function show(Desktop $desktop): Response
    {
        return $this->render('desktop/show.html.twig', [
            'desktop' => $desktop,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_desktop_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Desktop $desktop, DesktopRepository $desktopRepository): Response
    {
        $form = $this->createForm(DesktopType::class, $desktop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $desktopRepository->add($desktop);
            return $this->redirectToRoute('app_desktop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('desktop/edit.html.twig', [
            'desktop' => $desktop,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_desktop_delete", methods={"POST"})
     */
    public function delete(Request $request, Desktop $desktop, DesktopRepository $desktopRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$desktop->getId(), $request->request->get('_token'))) {
            $desktopRepository->remove($desktop);
        }

        return $this->redirectToRoute('app_desktop_index', [], Response::HTTP_SEE_OTHER);
    }
}
