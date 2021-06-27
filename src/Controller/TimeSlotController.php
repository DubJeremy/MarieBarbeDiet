<?php

namespace App\Controller;

use App\Entity\TimeSlot;
use App\Form\TimeSlotType;
use App\Repository\BookingRepository;
use App\Repository\TimeSlotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TimeSlotController extends AbstractController
{
    /**
     * @Route("/booking", name="app_booking_index")
     */
    public function index(TimeSlotRepository $calendar, BookingRepository $booking): Response
    {
        $events = $calendar->findAll();
        $appointments = $booking->findAll();

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

        foreach($appointments as $appointment)
        {
            $book[] = [
                'id' => $appointment->getId(),
                'start' => $appointment->getStart()->format('Y-m-d H:i:s'),
                'end' => $appointment->getEnd()->format('Y-m-d H:i:s'),
                'backgroundColor' => $event->getBackgroundColor(),
                'borderColor' => $event->getBorderColor(),
                'textColor' => $event->getTextColor(),
            ];
        }

        $data1 = json_encode($timeslots);
        $data2 = json_encode($book);

        return $this->render('booking/index.html.twig', compact('data1', 'data2'));
    }

    /**
    *@Route("/booking/new",name="app_booking_create", methods="GET|POST")
    */
    public function createTimeSlot(EntityManagerInterface $em, Security 
    $security, Request $request)
    {
        $timeSlot = new TimeSlot();
        $form = $this->createForm(TimeSlotType::class, $timeSlot);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($timeSlot);
            $em->flush();
            $this->addFlash('success', 'Créneaux horaire est créé');
            return $this->redirectToRoute('app_booking_index');
        }
        return $this->render('booking/new.html.twig', [
        'TimeSlotForm'=>$form->createView(),
        ]);
    }
}
