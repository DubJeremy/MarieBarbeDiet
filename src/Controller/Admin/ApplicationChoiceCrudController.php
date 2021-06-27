<?php

namespace App\Controller\Admin;

use App\Entity\ApplicationChoice;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ApplicationChoiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ApplicationChoice::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Application Visio');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('choice')
                ->setLabel('Choix'),
        ];
    }
}
