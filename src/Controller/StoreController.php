<?php

namespace App\Controller;

use App\Entity\Store\Product;
use App\Entity\Store\Brands;
use App\Repository\Store\ProductRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class StoreController extends AbstractController
{

    private $em;
    public function __construct( EntityManagerInterface $em, private CommentRepository $cm)
    {
        $this->em = $em;
    }

    #[Route('/store/product/{id}/{slug}', name: 'store_show_product', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showProduct(Request $request, int $id, string $slug): Response
    {
        
        return $this->render('store/index.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id,
            'slug' => $slug
        ]);
    }

    #[Route('/products', name: 'store_products')]
    public function produits(): Response
    {

        $products = $this->em->getRepository(Product::class)->findAll();


        return $this->render('main/product-list.html.twig', [
            'products' => $products,
        ]);
    }


    // #[Route('/products/{brand}', name: 'store_products')]
    // public function productsWithBrand(?int $brand): Response
    // {

    //     $products = $this->pd->getProductsWithBrand($brand);

    //     return $this->render('main/product-list.html.twig', [
    //         'products' => $products,
    //     ]);
    // }

    public function listBrandscontact(): Response
    {
        $brands = $this->em->getRepository(Brands::class)->findAll();
        return $this->render('listBrand.html.twig', [
            'brands' => $brands,
        ]);
    }
}
