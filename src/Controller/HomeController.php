<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SettingsRepository;
use App\Repository\SliderRepository;
use App\Repository\ArticleRepository;
use App\Repository\ProviderRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(SettingsRepository $settingsRepository, SliderRepository $sliderRepository,ArticleRepository $articleRepository, ProviderRepository $providerRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'settings' => $settingsRepository->findAll(),
            'sliders'=>$sliderRepository->findAll(),
            'articles' => $articleRepository->findAll(),
            'providers' => $providerRepository->findAll(),
        ]);
    }

    
    #[Route('/contacter', name: 'app_contacter')]
    public function addMessage(Request $request, ContactRepository $ContactRepository,SettingsRepository $settingsRepository): Response
    {
        if($request->getMethod()=="POST") {
            $contact = new Contact();
           
            $contact->setName($request->get("name"));
            $contact->setEmail($request->get("email"));
            $contact->setSubject($request->get("subject"));
            $contact->setMessage($request->get("message"));
            
            $ContactRepository->save($contact, true);

            //return new Response('Saved new product with id '.$product->getId());
            return $this->redirectToRoute('app_contacter', [], Response::HTTP_SEE_OTHER);
        } else {
            return $this->render('home/contact.html.twig', [
            'controller_name' => 'HomeController',
            'settings' => $settingsRepository->findAll(),
            
        
        ]);
        }
    }

    
}

