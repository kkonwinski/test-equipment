<?php

namespace App\Controller;

use App\Entity\Box;
use App\Entity\Runes;
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
    public function index(SessionInterface $session, BoxRepository $boxRepository)
    {

        $cartWithData = $session->get('cart', []);
        $boxes = [];
        dd($cartWithData);
        foreach ($cartWithData as $id => $value) {
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

        $cart['box'][$box->getId()] = 1;

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
    /**
     * @Route("/addRunes/{id}",name="add_runes_to_cart")
     */
    public function addRunesToCart(Runes $runes, SessionInterface $session)
    {
        $cart = $session->get('cart', []);

        $cart['runes'][$runes->getId()] = 1;

        $session->set('cart', $cart);

        return $this->json(
            $this->generateUrl('show_all_items'), 200
        );

    }

    /**
     * @Route("/remove/{id}", name="remove_runes",requirements={"id"="\d+"})
     */
    public function removeRunes(Runes $runes, Session $session)
    {
        $cart = $session->get('cart', []);

        if (!empty($cart[$runes->getId()])) {
            unset($cart[$runes->getId()]);
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show');

    }
}
