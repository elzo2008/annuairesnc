<?php

namespace App\Repository;

use App\Entity\InventaireMateriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InventaireMateriel>
 *
 * @method InventaireMateriel|null find($id, $lockMode = null, $lockVersion = null)
 * @method InventaireMateriel|null findOneBy(array $criteria, array $orderBy = null)
 * @method InventaireMateriel[]    findAll()
 * @method InventaireMateriel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InventaireMaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InventaireMateriel::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(InventaireMateriel $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(InventaireMateriel $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return InventaireMateriel[] Returns an array of InventaireMateriel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InventaireMateriel
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
