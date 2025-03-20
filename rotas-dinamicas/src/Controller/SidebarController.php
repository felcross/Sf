<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

class SidebarController extends AbstractController
{
   // #[Route('/sidebar/recent-news', name: 'app_sidebar_recent_news')]
    public function recentNews(): Response
    {
        // Prepare dummy recent news data (replace with your data source)
        $recentNews = [
            'News 1' => 'This is some recent news.',
            'News 2' => 'Another piece of recent news.',
        ];

        // Render the sidebar template
        $html = $this->renderView('sidebar/_recent_news.html.twig', [
            'recentNews' => $recentNews,
        ]);

        return new Response($html);
    }
}