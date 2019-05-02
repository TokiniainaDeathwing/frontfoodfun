<?php

namespace App\Repository;

use App\Entity\Plat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Plat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plat[]    findAll()
 * @method Plat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Plat::class);
    }

    // /**
    //  * @return Plat[] Returns an array of Plat objects
    //  */

    public function findPlatById($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT p.*,i.url,i.description as descriptionimage,i.type
         FROM plat p JOIN
          images i on i.idplat=p.id
          WHERE p.id = :id AND i.type=0;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll()[0];
    }
    public function findImagesByIdplat($id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT * FROM images where idplat=:id and type!=0 order by idplat limit 0,5;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
    public function findPlatsByCategorie($categorie): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT p.*,c.nom as categorie,i.url,i.description as descriptionimage,i.type
         FROM plat p 
         JOIN categorieplat 
         ca on ca.idplat=p.id 
         JOIN categorie c ON c.id=ca.idcategorie JOIN
          images i on i.idplat=p.id
          WHERE c.nom = :cat AND i.type=1;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['cat' => $categorie]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    /*
    public function findOneBySomeField($value): ?Plat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}
