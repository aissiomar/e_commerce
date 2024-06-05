// src/Controller/CartController.php

namespace App\Controller;

use App\Entity\Cart; // Assurez-vous d'avoir cette ligne d'importation
use App\Repository\CartRepository; // Assurez-vous d'avoir cette ligne d'importation
use App\Repository\ProductRepository; // Si vous en avez besoin, assurez-vous d'importer ProductRepository également
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    #[Route('/', name: 'cart_index', methods: ['GET'])]
    public function index(CartRepository $cartRepository): Response
    {
        $user = $this->getUser();
        $cart = $cartRepository->findOneBy(['user' => $user, 'status' => false]);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    // Autres méthodes de votre contrôleur
}
