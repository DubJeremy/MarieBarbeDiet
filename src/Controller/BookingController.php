<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(BookingRepository $calendar): Response
    {
        $events = $calendar->findAll();

        foreach($events as $event)
        {
            $timeslots[] = [
                'id' => $event->getId(),
                'start' => $event->getStart()->format('Y-m-d H:i:s'),
                'end' => $event->getEnd()->format('Y-m-d H:i:s'),
                'title' => $event->getTitle(),
                'description' => $event->getDescription(),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
            ];
        }

        $data = json_encode($timeslots);

        return $this->render('booking/index.html.twig', compact('data'));
    }

    /**
    *@Route("/booking/new",name="app_booking_create", methods="GET|POST")
    */
    public function createTimeSlot(EntityManagerInterface $em, Security 
    $security, Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($booking);
            $em->flush();
            $this->addFlash('success', 'Créneaux horaire est créé');
            return $this->redirectToRoute('app_booking_index');
        }
        return $this->render('booking/new.html.twig', [
        'TimeSlotForm'=>$form->createView(),
        ]);
    }
}
