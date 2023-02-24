<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Test;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index($note, $coefficient): Response
    {
        $note = new Test();
        $coefficient = new Test();
        $total = $note*$coefficient;
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
