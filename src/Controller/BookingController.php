<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingFormType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    /**
     * @Route("/booking", name="app_booking_index")
     */
    public function index(BookingRepository $booking, EntityManagerInterface $em, Security 
    $security, Request $request): Response
    {
        $events = $booking->findAll();
        $bookings = []; 

        foreach($events as $event)
        {
            $bookings[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                // 'title' => $event->getTitle(),
                // 'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
            ];
        }

        $data = json_encode($bookings);
        dd($data);
        // -------------------------------------------------
        $rdvs = new Booking();
        $form = $this->createForm(BookingFormType::class, $rdvs);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($rdvs);
            $em->flush();
            $this->addFlash('success', 'Votre demande à était enregistré.');
            return $this->redirectToRoute('app_booking_index');
        }
        return $this->render('booking/booking.html.twig', [
            compact('data'),
            'BookingForm'=> $form->createView(),
        ]);
    }

    // /**
    // *@Route("/booking", name="app_booking_create", methods="GET|POST")
    // */
    // public function createBooking(EntityManagerInterface $em, Security 
    // $security, Request $request)
    // {
    //     $booking = new Booking();
    //     $form = $this->createForm(Booking::class, $booking);
    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $em->persist($booking);
    //         $em->flush();
    //         $this->addFlash('success', 'Votre demande à était enregistré.');
    //         return $this->redirectToRoute('app_booking_index');
    //     }
    //     return $this->render('booking/booking.html.twig', [
    //     'BookingForm'=> $form->createView(),
    //     ]);
    // }
}
