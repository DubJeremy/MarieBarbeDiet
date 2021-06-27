<?php

namespace App\Controller\Admin;

use App\Entity\BookingType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BookingType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Type de rendez-vous');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('bookingType')
                ->setLabel('Type'),
        ];
    }
}
