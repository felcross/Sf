<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;




class ProductController extends AbstractController
{

    private array $products = [
        ['name' => 'Laptop', 'category' => 'electronics', 'price' => 1200],
        ['name' => 'T-Shirt', 'category' => 'clothing', 'price' => 25],
        ['name' => 'Mouse', 'category' => 'electronics', 'price' => 30],
        ['name' => 'Jeans', 'category' => 'clothing', 'price' => 70],
        ['name' => 'Tablet', 'category' => 'electronics', 'price' => 300],
        ['name' => 'Hat', 'category' => 'accessories', 'price' => 20],
    ];


    #[Route('/products/search', name: 'app_product_search')]
    public function search(Request $request): Response
    {
        $category = $request->query->get('category');
        $minPrice = $request->query->get('minPrice');
        $maxPrice = $request->query->get('maxPrice');

        $filteredProducts = $this->products; // Start with all products

        if ($category) {
            $filteredProducts = array_filter($filteredProducts, function ($product) use ($category) {
                return $product['category'] === $category;
            });
        }

        if ($minPrice) {
            $filteredProducts = array_filter($filteredProducts, function ($product) use ($minPrice) {
                return $product['price'] >= $minPrice;
            });
        }

        if ($maxPrice) {
            $filteredProducts = array_filter($filteredProducts, function ($product) use ($maxPrice) {
                return $product['price'] <= $maxPrice;
            });
        }

        return $this->render('product/search.html.twig', [
            'products' => $filteredProducts,
            'category' => $category,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
        ]);
    }
}






/*
    #[Route('/produto/{id}', name: 'detalhes_produto',requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function showProduct(int $id): Response
    {       return new Response('Product details for product ID: ' . $id);  }*/
