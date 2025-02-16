<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/weather', name:'TEMPO')]
class WeatherController extends AbstractController{


    #[Route('/highlanderSays/{param<\d+>?50}'/*,requirements:['param' => '\d+'],*/ ,name:'Previsão do tempo',methods:['GET','POST'])]
    public function highlanderSays(int $param ): Response  
    {
           // inteiro entre 0 e 100

           $draw = random_int(0,100);

           $forecast = $draw < $param ?"It's gonna rain":' Its going to be  sunny';

            
            return $this->render('weather/says.html.twig',[
                'forecast'=>$forecast,
            ]);

           //return new Response(
           //content:"<html><body>$forecast</body></html>"
        
        

    }

    #[Route('/highlanderSays/{param}',name:'Adivinhação do tempo',methods:['GET','POST'])]
    public function highlanderGuess(string $param ): Response  
    {
          

           $forecast = "It's gonna rain $param";

            
            return $this->render('weather/says.html.twig',[
                'forecast'=>$forecast,
            ]);

           //return new Response(
           //content:"<html><body>$forecast</body></html>"
        
        

    }


}
