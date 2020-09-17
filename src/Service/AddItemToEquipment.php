<?php


namespace App\Service;


use App\Entity\Equipment;
use App\Repository\BoxRepository;
use App\Repository\RunesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class AddItemToEquipment
{


    private $session;
    private $boxRepository;
    private $runesRepository;
    private $entityManager;

    public function __construct(SessionInterface $session, BoxRepository $boxRepository, RunesRepository $runesRepository, EntityManagerInterface $entityManager)
    {
        $this->session = $session;
        $this->boxRepository = $boxRepository;
        $this->runesRepository = $runesRepository;
        $this->entityManager = $entityManager;
    }


    /**
     * @param Equipment $equipment
     */
    public function addItemsEquipment(Equipment $equipment)
    {
        $arrItems = $this->session->get('cart', []);

        foreach ($arrItems as $type => $items) {
            switch ($type) {
                case "box":
                    $this->addBoxItemsToEquipment($items, $equipment);
                    break;
                case "runes":
                    $this->addRunesItemsToEquipment($items, $equipment);
                    break;
            }
        }

        $this->entityManager->flush();

        return true;

    }

    public function addBoxItemsToEquipment($items, $equipment)
    {
        foreach (array_keys($items) as $boxId) {
            $boxObject = $this->boxRepository->find($boxId);

            $equipment->addBox($boxObject);

            $this->entityManager->persist($equipment);
        }

    }

    public function addRunesItemsToEquipment($items, $equipment)
    {

        foreach (array_keys($items) as $runeId) {

            $runeObject = $this->runesRepository->find($runeId);

            $equipment->addRune($runeObject);
        }
        $this->entityManager->persist($equipment);

    }

}