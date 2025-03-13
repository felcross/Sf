<?php

declare(strict_types=1);

namespace App\Helper;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginHelper extends AbstractController
{
    
     public function LoginCode(): void
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





    file_put_contents('C:\\symfony-cli\\Emsoftapi\\var\\log\\','Logsys.lock');

 

    curl_close($curl);

    }


    public function LoginApi()

    { 
          
         $json =  http_build_query(['grant_type' =>'client_credentials',
         'client_secret' =>'66G7PjkU45u_..3O8_~~h4Gzpvr~IqTLbn',
         'client_id' =>'476c61c9-400d-4425-ad8f-ae7fcb169210',
         'scope' =>'api://efc01b40-db71-45fd-b196-93fdbc61fd0b/.default']);
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://login.microsoftonline.com/fastchannel.com/oauth2/v2.0/token',
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER =>['Content-Type: application/x-www-form-urlencoded'],
            CURLOPT_POSTFIELDS => $json 
            
        ]);
   
    $result = curl_exec($curl);

    $response = json_decode($result,true);

   //$session = new Session();
   //$session->start();
   //$session->set('Token2',$response['value']);
   



 

    curl_close($curl);

    return $response;

    }
}