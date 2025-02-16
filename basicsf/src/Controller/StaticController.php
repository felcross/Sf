<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/weather', name:'TEMPO')]
class StaticController extends AbstractController 
{
   #[Route('/static', name: 'esse é o teste')]
     public function weatherStatic(): Response
     {  
         // $msg = 'Deu certo';


        return $this->render('weather/static.html.twig',[
            'msg' => 'Deu certo via string',
        ]);
     }

}