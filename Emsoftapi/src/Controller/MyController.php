<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

//$session = new Session();
//$session->start();
//$session->has('testeSessionLogin');

class MyController extends AbstractController
{
    
      
    //#[Route("/data")]
     public function jokes(Request $request): Response
    {
         $endPoint = 'ServiceSistema/Login';
         $metodo  = 'POST';
         $post = ['usuario' => 'edson','senha' => 'chicosoft'];
         $token = null;

        $header = [
            'Content-Type: application/json',
        ];
    
        if ($token) {
            $header = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ];
        }
    

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://166.0.186.208:2002/emsoft/emauto/' . $endPoint,
            CURLOPT_CUSTOMREQUEST => $metodo,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER =>$header
            
        ]);

        if ($metodo == 'POST' || $metodo == 'PUT') {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
        }
   

        

    $result = curl_exec($curl);

    $resultado = [
        'status' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
        'response' => json_decode($result)
    ];

    $response = json_decode($result);

    $session = $request->getSession();
    $session->set('token',$response['value']);
    

    curl_close($curl);

    
    //return $resultado;

    return $this->json([
        'message' => 'Data fetched successfully!',
        'data' => $response ?? []
        
    ]);

    

      /*  $rawResponse = curl_exec($curl);
        $info = curl_getinfo($curl);
        curl_close($curl);

        if ($info['http_code'] === 200) {
             $response = json_decode($rawResponse, true);
             $jokes = $response['value'];
        }

        return $this->json([
            'message' => 'Data fetched successfully!',
            'data' => $jokes ?? []
            
        ]);

        return $this->render('jokes.html.twig', [
            'jokes' => $jokes ?? [],
        ]);*/

        
    }
}