<?php

namespace App\DataFixtures;

use App\Entity\Store\Product;
use App\Entity\Store\Brands;
use App\Entity\Image;
use App\Entity\Color;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /** @var ObjectManager */
    private $manager;
    
    private const DATA_BRANDS = [
        ['ADIDAS'],
        ['NIKE'],
        ['PUMAS'],
        ['ASICS']

    ];

    private const DATA_COLORS = [
        ['BLUE'],
        ['RED'],
        ['GREEN'],
        ['YELLOW'],
        ['PURPLE'],
        ['WHITE'],
        ['BLACK'],
        ['ORANGE'],
        ['GREY'],
    ];

    private const DATA_COMMENTS = [
        [
            'username' => 'Shandia',
            'message' => 'Abdoululu est absent'
        ],
        [
            'username' => 'Zisou',
            'message' => 'c\'est de la merde'
        ],
        [
            'username' => 'Ericu',
            'message' => 'bah je sais pas'
        ],
        [
            'username' => 'abdoul',
            'message' => 'I see you my friend'
        ],

    ];



    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->loadBrands();
        $this->loadColors();
        $this->loadProducts();
        $manager->flush();
    }

    public function loadBrands():void{
        foreach(self::DATA_BRANDS as $key => [$name]){
            $brand = (new Brands())
                ->setName($name);
            
            $this->manager->persist($brand);
            $this->addReference(Brands::class .$key, $brand);
        }
    }

    public function loadComments():void{
        foreach(self::DATA_COMMENTS as $key => [$name]){
            foreach(DATA_COMMENTS[$key] as $detailsComment => [$detail]){

            }
        }
    }

    public function loadColors():void{
        foreach(self::DATA_COLORS as $key => [$name]){
            $color = (new Color())
                ->setName($name);
            
            $this->manager->persist($color);
            $this->addReference(Color::class .$key, $color);
        }
    }


    private function loadProducts(): void
    {
        for($i = 1; $i < 15; $i++){
            /**@var Brands $brand */
            $brand = $this->getReference(Brands::class .random_int(0, count(self::DATA_BRANDS) - 1));
            
            $image = (new Image())

                ->setUrl("shoe-".$i."jpg")
                ->setAlt("shoe-".$i."jpg");

            $product = (new Product())
                ->setName('product '.$i)
                ->setDescription('Produit de description '.$i)
                ->setLongDescription('Produit de description '.$i)
                ->setPrice(mt_rand(10,100))
                ->setImage($image)
                ->setBrands($brand);

            for($j = 0; $j < random_int(0, count(self::DATA_COLORS)-1); $j++){
                if(random_int(0,1)){
                    /**@var Color $color */
                    $color = $this->getReference(Color::class .$j);
                    $product->addColor($color);
                }
            }
            
            $this->manager->persist($product);
            sleep(1);
        }
    }



}
