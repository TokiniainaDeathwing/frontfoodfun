<?php
namespace App\Service;

use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Reservation;
class ReservationService
{

    private $re;

    public function __construct(ManagerRegistry $re)
    {
        $this->re = $re;
    }
    //get ALL Categories of plats
    public function reserver($date,$nom)
    {
        $product=new Reservation();
        $product->setNom($nom);
        $product->setDate($date);
        $entityManager=$this->re->getManager();
        $entityManager->persist($product);
        $entityManager->flush();


    }
}