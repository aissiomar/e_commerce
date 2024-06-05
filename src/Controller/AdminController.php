<?php

namespace App\Controller;

use App\Repository\CartRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin_index', methods: ['GET'])]
    public function index(CartRepository $cartRepository): Response
    {
        $carts = $cartRepository->findBy(['status' => false]);

        return $this->render('admin/index.html.twig', [
            'carts' => $carts,
        ]);
    }

    #[Route('/users', name: 'admin_users', methods: ['GET'])]
    public function users(UserRepository $userRepository): Response
    {
        $users = $userRepository->findBy([], ['created_at' => 'DESC']);

        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    }
}
