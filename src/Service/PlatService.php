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
    //get Spécialite d'el Resto
    public function getSpecialités():? array
    {
        $product = $this->re
            ->getRepository(Plat::class)
            ->findPlatsByCategorie('specialite');
        return $product;


    }
   //find plat by Id
    public function getPlatById($id){

        $product = $this->re
            ->getRepository(Plat::class)
            ->findPlatById($id);
        return $product;

    }
//find images
    public function getImagePlat($id):? array{

        $product = $this->re
            ->getRepository(Plat::class)
            ->findImagesByIdplat($id);
        return $product;

    }


}