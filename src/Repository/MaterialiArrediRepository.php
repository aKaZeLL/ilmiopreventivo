<?php

namespace App\Repository;

use App\Entity\MaterialiArredi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MaterialiArredi>
 *
 * @method MaterialiArredi|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterialiArredi|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterialiArredi[]    findAll()
 * @method MaterialiArredi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterialiArrediRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaterialiArredi::class);
    }

    public function save(MaterialiArredi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MaterialiArredi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MaterialiArredi[] Returns an array of MaterialiArredi objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MaterialiArredi
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
