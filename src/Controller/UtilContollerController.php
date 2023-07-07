<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilContollerController extends AbstractController
{
    #[Route('/inscriptionOk', name: 'inscription_OK')]
    public function indexOK(): Response
    {
        return $this->render('util/indexok.html.twig', [
           // 'controller_name' => 'UtilController',
        ]);
    }

    #[Route('/inscriptionKo', name: 'inscription_KO')]
    public function indexKo(): Response
    {
        return $this->render('util/indexko.html.twig', [
           // 'controller_name' => 'UtilController',
        ]);
    }

}
