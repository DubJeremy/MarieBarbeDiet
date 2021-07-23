<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
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
            DateTimeField::new('start')
                ->setLabel('Début'),
            DateTimeField::new('end')
                ->setLabel('Fin'),
            AssociationField::new('applicationChoice')
                ->setLabel('App visio'),
            ColorField::new('backgroundColor')
                ->setLabel('Couleur')
                ->onlyOnIndex(),
            ChoiceField::new('backgroundColor')
                ->setLabel('Dispo/Indispo')
                ->onlyOnForms()
                ->setChoices([
                    'Disponible' => '#E8EFE9',
                    'Indispnible' => '#9C7A97'
                ]),
            TextField::new('message')
            ->setLabel('Messages'),           
        ];
    }
}
