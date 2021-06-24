<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home_index")
     */
    public function index(ReviewRepository $reviewRepository): Response
    {
        $reviews = $reviewRepository->findAll();

        return $this->render('home/index.html.twig', [
            'reviews' => $reviews ,
        ]);
    }

    /**
    *@Route("/review/new",name="app_home_createReview", methods="GET|POST")
    */
    public function createReview(EntityManagerInterface $em, Security 
    $security, Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $security->getUser();
            $review->setAuthor($user);
            $em->persist($review);
            $em->flush();
            $this->addFlash('success', 'Merci d\'avoi pris le temps de me laisser un avis! Marie B.');
            return $this->redirectToRoute('app_home_index');
        }
        return $this->render('review/create.html.twig', [
        'reviewForm'=>$form->createView(),
        ]);
    }
}
