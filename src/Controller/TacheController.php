<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;

use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;
use App\Service\StatsService;

/**
 * @Route("/tache")
 */
class TacheController extends AbstractController
{
    /**
     * @Route("/{page<\d+>?1}", name="app_tache_index", methods={"GET"})
     */
    public function index(TacheRepository $tacheRepository, $page = 1): Response
    {
        
        $limit = 10;
        $start = $page * $limit - $limit;
        $total  =count($tacheRepository->findAll());
        $pages = ceil($total / $limit); //3.4 => 4 pages

        return $this->render('tache/index.html.twig', [
            'taches' => $tacheRepository->findBy([], [], $limit, $start),
            'pages' => $pages,
            'page' => $page
        ]);
        
    }





    /**
     * @Route("/new", name="app_tache_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TacheRepository $tacheRepository): Response
    {
        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tacheRepository->add($tache);
            return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache/new.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_tache_show", methods={"GET"})
     */
    public function show(Tache $tache): Response
    {
        return $this->render('tache/show.html.twig', [
            'tache' => $tache,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_tache_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tache $tache, TacheRepository $tacheRepository): Response
    {
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tacheRepository->add($tache);
            return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tache/edit.html.twig', [
            'tache' => $tache,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_tache_delete", methods={"POST"})
     */
    public function delete(Request $request, Tache $tache, TacheRepository $tacheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tache->getId(), $request->request->get('_token'))) {
            $tacheRepository->remove($tache);
        }

        return $this->redirectToRoute('app_tache_index', [], Response::HTTP_SEE_OTHER);
    }
}
