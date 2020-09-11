<?php

namespace App\Controller;

use App\Repository\BoxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
{
    /**
     * @Route("/", name="show_all_items")
     */
    public function showAllItems(BoxRepository $boxRepository)
    {

        $allBoxes = $boxRepository->findAll();
        return $this->render('equipment/index.html.twig', [
            'boxes' => $allBoxes
        ]);
    }


}
