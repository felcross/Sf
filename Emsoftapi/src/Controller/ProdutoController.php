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

   
     #[Route("/emsoft/{filter}/{value}/{top}")]
     public function getProdutoEMsoft(string $top, string $filter, string $value): Response
    {                  
      $teste = "?%24filter={$filter}%20eq%20{'$value'}&%24top={$top}";
           

                                         
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://166.0.186.208:2002/emsoft/emauto/Produto?%24filter={$filter}%20eq%20{$value}&%24top={$top}",
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



    
    #[Route("/teste/{filter}/{value}/{top}/{letra}")]
     public function get(string $top, string $filter, string $value,string $letra): Response
    {        
        
          $teste = stripslashes("?%24filter={$filter}%20eq%20{$value}{$letra}%24top={$top}");
          
          //stripcslashes("?%24filter={$filter}%20eq%20{value}&%24top={$top}");
               
    

         return $this->json([
        'message' => 'Data fetched successfully!',
        'data' => $teste ??  []
       ]);
        
    }

    #[Route("/logar")]
    public function LoginCode(): Response
    {
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://166.0.186.208:2002/emsoft/emauto/ServiceSistema/Login',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER =>['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode(['usuario' => 'edson','senha' => 'chicosoft'])
            
        ]);
   
    $result = curl_exec($curl);

    $response = json_decode($result,true);

   $session = new Session();
   $session->start();
   $session->set('Token',$response['value']);





    //file_put_contents('C:\symfony-cli\Emsoftapi\var\log','Logsys.lock');

 

    curl_close($curl);

    
    return $this->json([
        'message' => 'Data fetched successfully!',
        'data' =>  $response['value'] ?? []
       ]);

    }
}