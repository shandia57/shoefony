<?php

namespace App\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;
use App\Entity\Contact;


class ContactMailer 
{
    private $mailer;
    private $twig;
    private string $contactEmailAddress;

    public function __construct(MailerInterface $mailer, string $contactEmailAddress, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->contactEmailAddress = $contactEmailAddress;
    }

    public function send(Contact $contact)
    {
        echo $contact->getEmail();
        $email = (new Email())
        ->from($contact->getEmail())
        ->to($this->contactEmailAddress)
        ->subject($contact->getMessage())
        ->html($this->twig->render('email/contact.html.twig', ['contact' => $contact->getEmail()]));

        $this->mailer->send($email);


    }
}