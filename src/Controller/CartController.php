<?php

namespace App\Controller;

use App\Entity\Box;
use App\Repository\BoxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/showCart", name="cart_show")
     */
    public function index(SessionInterface $session,BoxRepository $boxRepository)
    {

        $cartWithBoxes = $session->get('cart', []);
$boxes=[];
        foreach ($cartWithBoxes as $id=>$value) {
            $boxes[] = $boxRepository->find($id);
        }
        return $this->render('cart/index.html.twig', [
            'boxes' => $boxes
        ]);
    }


    /**
     * @Route("/addBoxes/{id}",name="add_boxes_to_cart")
     */
    public function addBoxesToCart(Box $box, SessionInterface $session)
    {
        $cart = $session->get('cart', []);

        $cart[$box->getId()] = 1;

        $session->set('cart', $cart);

        return $this->json(
            $this->generateUrl('show_all_items'), 200
        );

    }

    /**
     * @Route("/remove/{id}", name="remove_boxes",requirements={"id"="\d+"})
     */
    public function removeBoxes(Box $box, Session $session)
    {
        $cart = $session->get('cart', []);

        if (!empty($cart[$box->getId()])) {
            unset($cart[$box->getId()]);
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show');

    }
}
