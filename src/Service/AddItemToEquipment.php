<?php


namespace App\Service;


use App\Repository\BoxRepository;
use App\Repository\RunesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class AddItemToEquipment
{


    private $session;
    private $boxRepository;
    private $runesRepository;

    public function __construct(SessionInterface $session, BoxRepository $boxRepository, RunesRepository $runesRepository)
    {
        $this->session = $session;

        $this->boxRepository = $boxRepository;
        $this->runesRepository = $runesRepository;
    }


    /**
     * @return array
     */
    public function addItemsEquipment()
    {

        $arrItems = $this->session->get('cart', []);
        $tmpArr=array();
        if (!empty($arrItems)) {
            $arrayItemsIds = $this->mergeItems($arrItems);
            $tmpArr = array();
            foreach ($arrayItemsIds as $arrayItemsId) {
                if (!empty($this->runesRepository->find($arrayItemsId))) {
                    $tmpArr[] = $this->runesRepository->find($arrayItemsId);
                } elseif(!empty($this->boxRepository->find($arrayItemsId))) {
                    $tmpArr[] = $this->boxRepository->find($arrayItemsId);

                }else{
                    $ex=new \Exception();
                    $ex->getMessage();
                    die;
                }
            }
        }
       return $tmpArr;

    }

    /**
     * @param array $mergeArrayItems
     * @return array
     */
    public function mergeItems(array $mergeArrayItems)
    {
        $tmpArr = array();
        foreach ($mergeArrayItems as $mergeArrayItem) {
            foreach ($mergeArrayItem as $id => $value) {
                $tmpArr[] = $id;
            }
        }

        return $tmpArr;

    }

//    public function addRunesEquipment(array $arrayWihRunesIds)
//    {
//        $tmpArr = [];
//
//        foreach ($arrayWihRunesIds as $id => $value) {
//            //   var_dump($arrayWihBoxesId);
//            $tmpArr[] = $this->runesRepository->find($id);
//
//        }
//        return $tmpArr;
//
//    }
}