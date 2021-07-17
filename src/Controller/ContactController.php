<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Manager\ContactManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact_contact")
     * @param Request $request
     * @param ContactManager $contactManager
     * @return Response
     */
    public function contact(Request $request, ContactManager $contactManager
    ): Response
    {
        $contact = new Contact();
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) 
        {
            $contactManager->sendContact($contact);

            return $this->redirectToRoute('app_contact_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'formContact' => $formContact->createView()
        ]);
    }
}