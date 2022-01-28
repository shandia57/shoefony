<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @ORM\Table(name="app_contact")
 */
class Contact
{
    public function __construct(){
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    private ?string $firstname = null;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    private ?string $lastname = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    #[Assert\Email(message: "L'email {{ value }} n'est pas valide")]
    private ?string $email = null;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    #[Assert\Length(min:"25", minMessage: 'Ce champs doit contenir au minimum {{ limit }} caractères')]
    private ?string $message = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getFirstname() : string
    {
        return $this->firstname;
    }


    public function setFirstname($firstname) : Contact
    {
        $this->firstname = $firstname;

        return $this;
    }


    public function getLastname() : string
    {
        return $this->lastname;
    }


    public function setLastname($lastname) : Contact
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function getEmail() : string
    {
        return $this->email;
    }


    public function setEmail($email) : Contact
    {
        $this->email = $email;

        return $this;
    }


    public function getMessage() : string
    {
        return $this->message;
    }

    public function setMessage($message) : Contact
    {
        $this->message = $message;

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

}