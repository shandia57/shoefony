<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    private ?string $firstname = null;

    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    private ?string $lastname = null;

    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    #[Assert\Email(message: "L'email {{ value }} n'est pas valide")]
    private ?string $email = null;

    #[Assert\NotBlank(message: 'Ce champs ne peut pas être vide')]
    #[Assert\Length(min:"25", minMessage: 'Ce champs doit contenir au minimum {{ limit }} caractères')]
    private ?string $message = null;


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


}