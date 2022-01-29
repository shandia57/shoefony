<?php

namespace App\Entity\Store;

use App\Entity\Color;
use App\Entity\Image;
use App\Repository\Store\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use function Symfony\Component\String\u;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="sto_product")
 */
class Product
{
    public function __construct(){
        $this->createdAt = new \DateTime();
        $this->color = new ArrayCollection();
        $this->brands = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=Image::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Image;

    /**
     * @ORM\Column(type="text")
     */
    private $longDescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


    /**
     * @ORM\ManyToOne(targetEntity=Brands::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Brands;

    /**
     * @ORM\ManyToMany(targetEntity=Color::class)
     */
    private $color;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {

        return $this->name;
    }

    public function setName(?string $name): self
    {

        $this->name = $name;
        $this->slug = u($name)->lower()->replace(' ', '-')->toString();

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setCreatedAt($createdAt) : self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    

    public function getImage(): ?Image
    {
        return $this->Image;
    }

    public function setImage(Image $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): self
    {
        $this->longDescription = $longDescription;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getBrands(): ?Brands
    {
        return $this->Brands;
    }

    public function setBrands(?Brands $Brands): self
    {
        $this->Brands = $Brands;

        return $this;
    }

    /**
     * @return Collection|Color[]
     */
    public function getColor(): Collection
    {
        return $this->color;
    }

    public function addColor(Color $color): self
    {
        if (!$this->color->contains($color)) {
            $this->color[] = $color;
        }

        return $this;
    }

    public function removeColor(Color $color): self
    {
        $this->color->removeElement($color);

        return $this;
    }



    
}
