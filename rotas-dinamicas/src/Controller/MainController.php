<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
           // Prepare main page content (dummy data in this example)
           $mainContent = 'This is the main page content.';

           // Forward to SidebarController for recent news
           $sidebarResponse = $this->forward('App\Controller\SidebarController::recentNews');
   
           // Combine main content and sidebar
           return $this->render('base.html.twig', [
               'mainContent' => $mainContent,
               'sidebar' => $sidebarResponse->getContent(),
           ]);
    }


}