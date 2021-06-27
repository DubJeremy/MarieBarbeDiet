<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Rendez-vous');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('author')
                ->setLabel('Patient'),
            AssociationField::new('bookingType')
                ->setLabel('Type de réservation'),
            AssociationField::new('applicationChoice')
                ->setLabel('App visio'),
            ColorField::new('backgroundColor')
                ->setLabel('Couleur du fond'),
            ColorField::new('borderColor')
                ->setLabel('Couleur de la bordure')
                ->hideOnIndex(),
            ColorField::new('textColor')
                ->setLabel('Couleur du texte')
                ->hideOnIndex(),
            
        ];
    }
}
