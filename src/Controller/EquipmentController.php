<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Repository\BoxRepository;
use App\Repository\RunesRepository;
use App\Service\AddItemToEquipment;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
{
    /**
     * @Route("/", name="show_all_items")
     * @param BoxRepository $boxRepository
     * @param RunesRepository $runesRepository
     * @param PaginatorInterface $paginator
     * @param SessionInterface $session
     * @param CartController $cartController
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAllItems(BoxRepository $boxRepository, RunesRepository $runesRepository, PaginatorInterface $paginator, SessionInterface $session, CartController $cartController, Request $request)
    {
        $countItemsCart = $cartController->countCartElements($session);
        $allRunes = $runesRepository->findAll();
        $allBoxes = $boxRepository->findAll();
//        $allBoxes = $paginator->paginate($getAllBoxes, $request->query->getInt('box', 1), 4);
//        $allRunes = $paginator->paginate($getAllRunes, $request->query->getInt('box', 1), 4);
        return $this->render('equipment/index.html.twig', [
            'boxes' => $allBoxes,
            'runes' => $allRunes,
            'countItemsCart' => $countItemsCart
        ]);
    }

    /**
     * @param Equipment $equipment
     * @param SessionInterface $session
     * @param AddItemToEquipment $toEquipment
     * @Route("/addItemsToEquipment",name="add_items_to_equipment")
     */
    public function addToEquipment(SessionInterface $session,AddItemToEquipment $toEquipment)
    {

$objectItems= $toEquipment->addItemsEquipment($session);
//        $this->em->persist($product);
//        $this->em->flush();
        //    $entityManager = $this->getDoctrine()->getManager();
}

}
