<?php

namespace App\Repository\Store;

use App\Entity\Store\Product;
use App\Entity\Store\Brands;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);

    }

    public function ShowAllProducts(): Array{
        $products = $this->getDoctrine()->getManager();
        $records = $products->getRepository("App\Entity\Store\Product")->findAll();
        return $records;
    }

    public function findLastFour(): Array{

        return $this
            ->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    public function findFourProductsMoreCommented():array{
        return $this
        ->createQueryBuilder('p')
        ->leftJoin('p.comments', 'c')
        ->groupBy('p')
        ->orderBy('COUNT(c.id)', 'DESC')
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }

    public function getProductsWithBrand(Brands $brand):array{
        return $this
            ->createQueryBuilder('p')
            ->where('p.Brands = :brand')
            ->setParameter('brand', $brand)
            ->getQuery()
            ->getResult();    
        ;
    }
    
}
