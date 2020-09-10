<?php

namespace App\Controller;

use App\Repository\BoxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("addBoxesToItem/{id}",name="add_boxes_to_item")
     */
    public function addBoxesToItem($id, Request $request)
    {
        dd($request);
    }

}
