<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    #[Route('/store/product/{id}/details', name: 'store_show_product', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function showProduct(Request $request, int $id): Response
    {
        return $this->render('store/index.html.twig', [
            'controller_name' => 'StoreController',
            'id' => $id,
        ]);
    }

    #[Route('/products', name: 'store_products')]
    public function produits(): Response
    {
        return $this->render('main/product-list.html.twig', [
            
        ]);
    }
}
