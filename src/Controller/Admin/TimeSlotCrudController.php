<?php

namespace App\Controller\Admin;

use App\Entity\TimeSlot;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TimeSlotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TimeSlot::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'RDV');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            DateTimeField::new('start')
            ->setLabel('Début'),
            DateTimeField::new('end')
            ->setLabel('Fin'),
            TextField::new('description')
            ->setLabel('Description'),
            ColorField::new('backgroundColor')
            ->setLabel('Couleur du fond'),
            ColorField::new('borderColor')
            ->setLabel('Couleur de la bordure'),
            ColorField::new('textColor')
            ->setLabel('Couleur du texte'),
            
        ];
    }
}
