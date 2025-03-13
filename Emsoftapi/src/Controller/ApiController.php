<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;


 class ApiController extends AbstractController
{ 

     

     public function __construct(private HttpClientInterface $client) 
            {}
          

   // #[Route('/api/data')]
    public function fetchData(string $endPoint = 'ServiceSistema/Login', string $metodo  = 'POST', array $post = ['usuario' => 'edson','senha' => 'chicosoft']  , string|null $token = null): Response

    {    

        // Create an instance of the HTTP Client.
        $client = HttpClient::create(['verify_peer' => false, 'verify_host' => false]);


        $header = [
            'Content-Type: application/json',
        ];
    
        if ($token) {
            $header = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ];
        }

     $senha = json_encode($post);

        // Define the external API endpoint.
        $apiUrl = 'http://166.0.186.208:2002/emsoft/emauto/' . $endPoint .'/' . $metodo .'/' . $senha .'/' . $token;

        echo  $apiUrl;

        // Send a GET request to the external API.
        $response = $client->request($metodo , $apiUrl,[
            'headers' => [
                'content-type' => 'application/json',
            ],
        ]);

        // Ensure the request was successful (HTTP 200 OK).
        if ($response->getStatusCode() !== 200) {
            return new Response('Error fetching data from API.', Response::HTTP_BAD_REQUEST);
        }

        // Decode the JSON response into a PHP array.
        $data = $response->toArray();

        // Render a template or return JSON data.
        // Here, we simply return a JSON response for demonstration.
        

        return $this->json([
            'message' => 'Data fetched successfully!',
            'data' => $data
            
        ]);
    } 

    //#[Route('/api/data')]
    public function fetchData3(string $endPoint = 'ServiceSistema/Login', string $metodo  = 'POST', array $post = ['usuario' => 'edson','senha' => 'chicosoft']  , string|null $token = 'hda8hd8a8hd8ah'): Response
    {  
        
        // Create an instance of the HTTP Client.
      /*  $client = HttpClient::create(['verify_peer' => false, 'verify_host' => false]);

        $header = [
            'Content-Type: application/json',
        ];
    
        if ($token) {
            $header = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ];
        }

        

        $response = $client->request($metodo , $endPoint);
        

        $data = $response->toArray();
        */
   // $data = $req = Request::create()

        return $this->json([
            'message' => 'Data fetched successfully!',
        //    'data2'=> $data 
           
            /* 'data' => $endPoint,
            'data2'=> $metodo,
            'data3'=> $post,
            'data4'=> $token*/
            
            
        ]);

      }


   //#[Route('/api/data')]
    public function fetchData2(): Response
    {
        // Create an instance of the HTTP Client.
        $client = HttpClient::create(['verify_peer' => false, 'verify_host' => false]);
       

        // Define the external API endpoint.
        $apiUrl = 'https://pokeapi.co/api/v2/pokemon/pikachu';

        // Send a GET request to the external API.
        $response = $client->request('GET', $apiUrl);

        // Ensure the request was successful (HTTP 200 OK).
        if ($response->getStatusCode() !== 200) {
            return new Response('Error fetching data from API.', Response::HTTP_BAD_REQUEST);
        }

        // Decode the JSON response into a PHP array.
        $data = $response->toArray();

        // Render a template or return JSON data.
        // Here, we simply return a JSON response for demonstration.
        return $this->json([
            'message' => 'Data fetched successfully!',
            'data' => $data['name'],
            'abilidades' => $data['abilities'],
        ]);
    }
}
