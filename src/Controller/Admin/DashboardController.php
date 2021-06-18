<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Recipe;
use App\Entity\Review;
use App\Entity\UserCategory;
use App\Controller\Admin\UserCrudController;
use App\Entity\Difficulty;
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
        yield MenuItem::linkToCrud('Users', 'fas fa-angle-right', User::class);
        yield MenuItem::linkToCrud('Posts', 'fas fa-angle-right', Post::class);
        yield MenuItem::linkToCrud('Recettes', 'fas fa-angle-right', Recipe::class);
        yield MenuItem::linkToCrud('Avis', 'fas fa-angle-right', Review::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-angle-right', UserCategory::class);
        yield MenuItem::linkToCrud('Niveau de difficulté', 'fas fa-angle-right', Difficulty::class);
        yield MenuItem::linkToRoute('Home', 'fa fa-home', "app_home_index");
    }
}
