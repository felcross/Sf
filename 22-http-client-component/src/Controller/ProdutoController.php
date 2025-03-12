<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use App\Helper\LoginHelper;

class ProdutoController extends AbstractController
{     

    
     private Session $session;
     private LoginHelper $loginHelper;
         
    public function __construct(LoginHelper $loginHelper)
    {
        $this->loginHelper = $loginHelper;
        $this->session = new Session();
       
    }

   
     //#[Route("/emsoft")]
     public function getProdutoEMsoft(): Response
    {  
        $this->loginHelper->LoginCode();
      


         
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://166.0.186.208:2002/emsoft/emauto/Produto?%24top=2',
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER =>['Content-Type: application/json','Authorization: Bearer ' . $this->session->get('Token')]
            
        ]);
           
        $result = curl_exec($curl);

        $response = json_decode($result,true);


        curl_close($curl);



         return $this->json([
        'message' => 'Data fetched successfully!',
        'data' => $response ?? []  
       ]);
        
    }



    #[Route("/api")]
     public function getProdutoApi(): Response
    { 
       $response =  $this->loginHelper->LoginApi();



         return $this->json([
        'message' => 'Data fetched successfully!',
        'data' => $response ?? []  
       ]);
        
    }
}