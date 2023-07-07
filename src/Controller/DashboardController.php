<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
    $var1 = "modif user";
    #[Route('/admin', name: 'app_dashboard_admin')]
    public function indexAdmin(): Response
    {
        return $this->render('dashboard/indexAdmin.html.twig', [
            'controller_name' => 'Espace Administration',
        ]);
    }

    #[Route('/user', name: 'app_dashboard_user')]
    public function indexUser(): Response
    {
        return $this->render('dashboard/indexUser.html.twig', [
            'controller_name' => 'Espace Client ',
        ]);
    }
}
