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

   
     //#[Route("/emsoft/{filter}/{value}/{top}/{letra}")]
     #[Route("/emsoft/{qtd}")]
     public function getProdutoEMsoft(string $qtd = '0'): Response
    {                  
          //  $url = "http://166.0.186.208:2002/emsoft/emauto/Produto?%24filter={$filter}%20eq%20{$value}&%24top={$top}";
           // $url2 = 'http://166.0.186.208:2002/emsoft/emauto/ServiceEcommerce/ProdutosAlterados?pData=2024-10-10&pIntegrados=S&pRegistros=2&pPagina=0' ;

                                         
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://166.0.186.208:2002/emsoft/emauto/Produto?%24filter=WEB%20eq%20'S'&%24top={$qtd}",
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
        'data' =>  $response ?? []
       ]);
        
    }



   #[Route("/logar")]
     public function logarfastchannel():Response
    { 
       // $this->loginHelper->LoginApi();

        $this->loginHelper->LoginEmsoft();

       return $this->json([
        'message' => 'Data fetched successfully!',
        
       ]);
   }


    

    #[Route("/get")]
     public function getProduto(): Response
    { 

        $paginacao = 'https://api.commerce.fastchannel.com/stock-management/v1/stock?PageNumber=1&PageSize=5';
     
 
       $curl = curl_init();
       curl_setopt_array($curl, [
           CURLOPT_URL =>   $paginacao ,
           CURLOPT_CUSTOMREQUEST => 'GET',
           CURLOPT_SSL_VERIFYPEER => false,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_HTTPHEADER =>['Content-Type: application/json','Authorization: Bearer ' . $this->session->get('Token2'),'Subscription-Key:' . '4079282087f54f93b6f942245017a6d8'],
           ]);
  
   $result = curl_exec($curl);

   $response = json_decode($result,true);

    curl_close($curl);

    return $this->json([
        'message' => 'Data fetched successfully!',
        'data' => $response ?? []  
       ]);
        
    }  




    
    #[Route("/update")]
     public function teste(): Response
    {        
        $curl2 = curl_init();
        curl_setopt_array($curl2, [
            CURLOPT_URL => 'https://api.commerce.fastchannel.com/stock-management/v1/stock/31012653',
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->session->get('Token2'),
                'Subscription-Key: 4079282087f54f93b6f942245017a6d8'
            ],CURLOPT_POSTFIELDS => json_encode(['StorageId'=> 23, 'Quantity' => 100])
            //CURLOPT_POSTFIELDS =>    json_encode(['Quantity' => 100])
        
            
        ]);



        $result = curl_exec($curl2);
        
        $response = json_decode($result,true);
        
                  curl_close($curl2);
                  
          
                 return $this->json([
                'message' => 'Data fetched successfully!',
                'data' => $response ?? []  
               ]);
          
       
    

        
    }

 
}