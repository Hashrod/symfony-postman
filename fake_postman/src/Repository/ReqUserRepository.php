<?php

namespace App\Repository;

use App\Entity\ReqUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @method ReqUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReqUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReqUser[]    findAll()
 * @method ReqUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReqUserRepository extends ServiceEntityRepository
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, ReqUser::class);
        $this->security = $security;
    }

    public function findAllByUser()
    {
        $user = $this->security->getUser();
        return $this->createQueryBuilder('p')
            ->where('p.UserReq = :id')
            ->setParameter('id', $user);
    }

    // /**
    //  * @return ReqUser[] Returns an array of ReqUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReqUser
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
