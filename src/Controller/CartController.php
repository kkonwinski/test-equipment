<?php

namespace App\Controller;

use App\Entity\Box;
use App\Entity\Equipment;
use App\Entity\Runes;
use App\Repository\BoxRepository;
use App\Repository\RunesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{

    private $session;

    public function __construct(SessionInterface $session)
    {

        $this->session = $session;
    }
    /**
     * @Route("/showCart", name="cart_show")
     */
    public function index(BoxRepository $boxRepository, RunesRepository $runesRepository)
    {

        $cartWithData = $this->session->get('cart', []);

        $boxes = [];
        $runes = [];
        if (!empty($cartWithData['box'])) {
            foreach ($cartWithData['box'] as $id => $value) {
                $boxes[] = $boxRepository->find($id);
            }
        }
        if (!empty($cartWithData['runes'])) {
            foreach ($cartWithData['runes'] as $id => $value) {
                $runes[] = $runesRepository->find($id);
            }
        }
        return $this->render('cart/index.html.twig', [
            'boxes' => $boxes,
            'runes' => $runes
        ]);
    }


    /**
     * @Route("/addBoxes/{id}",name="add_boxes_to_cart")
     */
    public function addBoxesToCart(Box $box)
    {
        $cart = $this->session->get('cart', []);
        $cart['box'][$box->getId()] = 1;

        $this->session->set('cart', $cart);

        return $this->json(
            $this->generateUrl('show_all_items'), 200
        );

    }

    /**
     * @Route("/remove/box/{id}", name="remove_boxes",requirements={"id"="\d+"})
     */
    public function removeBoxes(Box $box)
    {
        $cart = $this->session->get('cart', []);
        if (!empty($cart['box'])) {
                unset($cart['box'][$box->getId()]);
        }
        $this->session->set('cart', $cart);

        return $this->redirectToRoute('cart_show');

    }

    /**
     * @Route("/remove/runes/{id}", name="remove_runes",requirements={"id"="\d+"})
     */
    public function removeRunes(Runes $runes)
    {
        $cart = $this->session->get('cart', []);
        if (!empty($cart['runes'])) {
            unset($cart['runes'][$runes->getId()]);
        }

        $this->session->set('cart', $cart);

        return $this->redirectToRoute('cart_show');

    }

    /**
     * @Route("/addRunes/{id}",name="add_runes_to_cart")
     */
    public function addRunesToCart(Runes $runes)
    {
        $cart = $this->session->get('cart', []);

        $cart['runes'][$runes->getId()] = 1;

        $this->session->set('cart', $cart);

        return $this->json(
            $this->generateUrl('show_all_items'), 200
        );

    }

    /**
     * @Route("clearCart", name="clear_cart")
     */
    public function clearCart()
    {
        $this->session->remove('cart');
        return $this->redirectToRoute('show_all_items');
    }

//    /**
//     * @param Box $box
//     * @Route("/addToEquipment", name="add_to_equipment")
//     */
//    public function addBoxesToEquipment( Box $box, Equipment $equipment)
//    {
//        $cart = $this->session->get('cart', []);
//        dd($cart['box']);
//
//    }

    public function countCartElements()
    {
        $cart = $this->session->get('cart', []);

        $itemNumber = [];
        foreach ($cart as $item) {
            if (!empty($item) && is_array($item)) {
                $itemNumber[] = array_sum($item);
            } else {
                $itemNumber[] = 0;
            }
        }
        return array_sum($itemNumber);

    }
}
