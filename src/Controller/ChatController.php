<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Form\ChatType;
use App\Repository\ChatRepository;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chat')]
class ChatController extends AbstractController
{
    #[Route('/', name: 'app_chat_index', methods: ['GET'])]
    public function index(ChatRepository $chatRepository): Response
    {
        return $this->render('chat/index.html.twig', [
            'chats' => $chatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChatRepository $chatRepository, RoomRepository $roomRepository, UserRepository $userRepository, $id): Response
    {
        $chat = new Chat();

        // Récupérer la Room sélectionnée par l'utilisateur
        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        // Renseigner l'ID de la Room dans le formulaire de Chat
        $chat->setRoom($room);
        //Récupérer l'ID du user connecté
        $user = $this->getUser();
        $userId = $user->getId();
        $user = $userRepository->find($userId);

        $form = $this->createForm(ChatType::class, $chat, [
            'user' => $user,
            'action' => $this->generateUrl('chat_create', ['roomId' => $id]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chatRepository->save($chat, true);

            return $this->redirectToRoute('app_chat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chat/new.html.twig', [
            'chat' => $chat,
            'form' => $form,
            'rooms' => $roomRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_chat_show', methods: ['GET'])]
    public function show(Chat $chat): Response
    {
        return $this->render('chat/show.html.twig', [
            'chat' => $chat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chat $chat, ChatRepository $chatRepository): Response
    {
        $form = $this->createForm(ChatType::class, $chat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chatRepository->save($chat, true);

            return $this->redirectToRoute('app_chat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chat/edit.html.twig', [
            'chat' => $chat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chat_delete', methods: ['POST'])]
    public function delete(Request $request, Chat $chat, ChatRepository $chatRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chat->getId(), $request->request->get('_token'))) {
            $chatRepository->remove($chat, true);
        }

        return $this->redirectToRoute('app_chat_index', [], Response::HTTP_SEE_OTHER);
    }
}
