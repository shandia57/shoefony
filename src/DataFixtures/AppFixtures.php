<?php

namespace App\DataFixtures;

use App\Entity\Store\Product;
use App\Entity\Store\Brand;
use App\Entity\Image;
use App\Entity\Colors;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /** @var ObjectManager */
    private $manager;
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->loadProducts();
        $manager->flush();
    }

    private function loadProducts(): void
    {
        for($i = 1; $i < 15; $i++){
            
            $image = (new Image())

                ->setUrl("shoe-".$i."jpg")
                ->setAlt("shoe-".$i."jpg");

            $product = (new Product())
                ->setName('product '.$i)
                ->setSlug('product-'.$i)
                ->setDescription('Produit de description '.$i)
                ->setLongDescription('Produit de description '.$i)
                ->setPrice(mt_rand(10,100))
                ->setImage($image);

            $brand = (new Brand())
                ->setName('Nike')
                ->setProduct($product);
            
            $this->manager->persist($product);
            $this->manager->persist($brand);
        }
    }



}
