<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DevelopmentRepository;
use App\Repository\EditionRepository;
use App\Repository\GameRepository;
use App\Repository\PegiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function index(GameRepository $gameRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'games' => $gameRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
