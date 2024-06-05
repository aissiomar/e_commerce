<?php

use App\Entity\Cart; // Assurez-vous d'avoir cette ligne d'importation
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account')]
class AccountController extends AbstractController
{
    #[Route('/', name: 'account_index', methods: ['GET'])]
    public function index(CartRepository $cartRepository): Response
    {
        $user = $this->getUser();
        $orders = $cartRepository->findBy(['user' => $user, 'status' => true]);

        return $this->render('account/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/order/{id}', name: 'account_order', methods: ['GET'])]
    public function order(Cart $cart): Response
    {
        $this->denyAccessUnlessGranted('view', $cart);

        return $this->render('account/order.html.twig', [
            'cart' => $cart,
        ]);
    }
}
?>