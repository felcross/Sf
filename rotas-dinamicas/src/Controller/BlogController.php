<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;




class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index()
    {
        $blogPosts = [
            [
                'title' => 'A Beginner\'s Guide to Symfony 7',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'publishedAt' => new \DateTimeImmutable('2023-01-01'),
            ],
            [
                'title' => 'Using Twig Templates in Symfony 7',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'publishedAt' => new \DateTimeImmutable('2023-01-15'),
            ],
        ];

        return $this->render('blog/index.html.twig', [
            'blogPosts' => $blogPosts,
        ]);
    }
}


