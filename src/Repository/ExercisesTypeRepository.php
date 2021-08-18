<?php

namespace App\Repository;

use App\Entity\ExercisesType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ExercisesType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExercisesType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExercisesType[]    findAll()
 * @method ExercisesType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExercisesTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExercisesType::class);
    }

    // /**
    //  * @return ExercisesType[] Returns an array of ExercisesType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExercisesType
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
