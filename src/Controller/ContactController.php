<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Manager\ContactManager;
use App\Service\ContactService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact_index")
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

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $contactManager->sendContact($contact);
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/contact.html.twig', [
            'formContact' => $formContact->createView()
        ]);
    }

    // /**
    //  * @Route("/card", name="card")
    //  * @param Request $request
    //  * @param CardRepository $cardRepository
    //  * @param EntityManagerInterface $entityManager
    //  * @return Response
    //  */
    // public function card(Request $request, CardRepository $cardRepository, EntityManagerInterface $entityManager
    // ): Response
    // {
    //     $card = new Card();
    //     $card->setUrl('https://devsprof.fr');

    //     $formProduct = $this->createForm(CardType::class, $card);
    //     $formProduct->handleRequest($request);

    //     if ($formProduct->isSubmitted() && $formProduct->isValid()) {
    //         $entityManager->persist($card);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('card');
    //     }

    //     return $this->render('default/card.html.twig', [
    //         'formCard' => $formProduct->createView(),
    //         'cards' => $cardRepository->findAll()
    //     ]);
    // }
}