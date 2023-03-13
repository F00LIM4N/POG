<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'app_cart')]
    public function index(SessionInterface $session, GameRepository $gameRepository): Response
    {

        $panier = $session->get("panier", []);

        // "Fabrication" des données
        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantity) {
            $game = $gameRepository->find($id);
            $dataPanier[] = [
                "game" => $game,
                "quantity" => $quantity
            ];
            $total += $game->getPriceGame() * $quantity;
        }

        return $this->render('cart/index.html.twig', compact("dataPanier", "total"));
    }

    // On va stocker les infos du panier dans la super global SESSION
    #[Route('/add/{id}', name: 'app_cart_add')]
    public function add(Game $game, SessionInterface $session)
    {
        //Récupération du panier actuel
        $panier = $session->get("panier", []);
        $id = $game->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        //Sauvegarde de la quantité dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/remove/{id}', name: 'app_cart_remove')]
    public function remove(Game $game, SessionInterface $session)
    {
        //Récupération du panier actuel
        $panier = $session->get("panier", []);
        $id = $game->getId();

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        //Sauvegarde de la quantité dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/delete/{id}', name: 'app_cart_delete')]
    public function delete(Game $game, SessionInterface $session)
    {
        //Récupération du panier actuel
        $panier = $session->get("panier", []);
        $id = $game->getId();

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        //Sauvegarde de la quantité dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_cart");
    }

    #[Route('/delete', name: 'app_cart_delete_all')]
    public function deleteAll(SessionInterface $session)
    {

        $session->remove("panier", []);

        return $this->redirectToRoute("app_cart");
    }
}
