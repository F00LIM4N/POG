<?php

namespace App\Controller;

use App\Repository\ChatRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
    #[Route('/forum', name: 'app_forum')]
    public function index(RoomRepository $roomRepository, ChatRepository $chatRepository): Response
    //On crée un objet instansiable $roomRepository à partir de la classe RoomRepository
    {
        return $this->render('forum/index.html.twig', [
            'controller_name' => 'ForumController',

            //Pour accéder aux données du controller room
            'rooms' => $roomRepository->findAll(),

            'chats' => $chatRepository->findAll(),

        ]);
    }
}
