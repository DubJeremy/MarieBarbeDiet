<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\Review;
use App\Entity\Booking;
use App\Entity\Contact;
use App\Entity\TimeSlot;
use App\Entity\Difficulty;
use App\Entity\BookingType;
use App\Entity\UserCategory;
use App\Entity\ApplicationChoice;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());

        if ('jane' === $this->getUser()->getEmail()) {
            return $this->redirect('...');
        }

        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Marie Barbé');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fas fa-bars');
        yield MenuItem::linkToCrud('Patients', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Messages', 'far fa-comment', Contact::class);
        // yield MenuItem::linkToCrud('Disponibilités', 'far fa-calendar-minus', TimeSlot::class);
        // yield MenuItem::linkToCrud('Rendez-vous', 'far fa-calendar-alt', Booking::class);
        // yield MenuItem::linkToCrud('Posts', 'far fa-sticky-note', Post::class);
        yield MenuItem::linkToCrud('Recettes', 'fas fa-utensils', Recipe::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-angle-right', Review::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-angle-right', UserCategory::class);
        yield MenuItem::linkToCrud('Niveau de difficulté', 'fas fa-angle-right', Difficulty::class);
        // yield MenuItem::linkToCrud('Type de rendez-vous', 'fas fa-angle-right', BookingType::class);
        // yield MenuItem::linkToCrud('Application Visio', 'fas fa-angle-right', ApplicationChoice::class);
        yield MenuItem::linkToRoute('Accueil', 'fa fa-home', "app_home_index");
    }
}
