<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Mailer\ContactMailer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private ContactMailer $contactMailer;
    public function __construct(ContactMailer $contactMailer)
    {
        $this->contactMailer = $contactMailer;
    }

    #[Route('/', name: 'main_homepage')]
    public function homepage(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/presentation', name: 'main_presentation')]
    public function presentation(): Response
    {
        return $this->render('main/presentation.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/contact', name: 'main_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request): Response
    {
        // Création de notre entité et du formulaire basé dessus
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        // Demande au formulaire d'interpréter la Request
        $form->handleRequest($request);


        // Dans le cas de la soumission d'un formulaire valide
        if($form->isSubmitted() && $form->isValid()){

            // Actions à effectuer après envoi du formulaire
            $this->addFlash('success', 'Merci, votre message a été pris en compte !');
            
            $this->contactMailer->send($contact);

            return $this->redirectToRoute('main_contact');
        }

        return $this->render('main/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
