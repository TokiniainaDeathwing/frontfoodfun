<?php
namespace App\service;

use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\Plat;
class PlatService
{
    private $re;
    public function __construct(ManagerRegistry $re ){
        $this->re = $re;

    }
    public function getSpecialités():? array
    {
        $product = $this->re
            ->getRepository(Plat::class)
            ->findBy(array(),['id'=>'desc'],3);
        return $product;


    }


}