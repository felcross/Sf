<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

class ProductController2 extends AbstractController
{
    #[Route('/products', name: 'app_products_list')]
    #[Route('/items', name: 'app_items_list')]
    #[Route('/goods', name: 'app_goods_list')]
    public function listProducts(): Response
    {
        // Logic to fetch product data and prepare the response

        $products = [
            ['name' => 'Product 1', 'price' => 10],
            ['name' => 'Product 2', 'price' => 20],
            ['name' => 'Product 3', 'price' => 30],
        ];

        return $this->render('product/list.html.twig', [
            'products' => $products
        ]);
    }
}



/*
    #[Route('/produto/{id}', name: 'detalhes_produto',requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function showProduct(int $id): Response
    {       return new Response('Product details for product ID: ' . $id);  }*/
