<?php


namespace App\Repository;


use App\Entity\Buy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;



/**
 * @method Buy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Buy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Buy[]    findAll()
 * @method Buy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuyOneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Buy::class);
    }

    /**
     * @return Buy[]
     */

    public function findAllVisible():array
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult()
            ;
    }


    /**
     * @return Buy[]
     */
    public function findLatest():array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
    }
    private function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold=false');
    }

}