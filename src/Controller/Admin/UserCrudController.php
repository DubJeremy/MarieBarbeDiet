<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Patients');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
                ImageField::new('profilePicture')
                    ->setBasePath('images/media/')
                    ->onlyOnIndex()
                    ->setLabel('Photo de profil'),
                TextField::new('profilePictureFile')
                    ->setFormType(VichImageType::class)
                    ->hideOnIndex()
                    ->setLabel('Photo de profil')
                    ->setFormTypeOption('allow_delete',true),
                TextField::new('fullName')
                    ->hideOnForm()
                    ->setLabel('Prénom Nom'),
                TextField::new('firstname')->hideOnIndex(),
                TextField::new('lastname')->hideOnIndex(),
                TextField::new('email'),
                AssociationField::new('userCategory')->hideOnForm()
                    ->setLabel('Catégorie'),
                DateTimeField::new('calculAge')
                    ->hideOnForm()
                    ->setLabel('Age'),
                DateField::new('age')
                    ->setLabel('Date de Naissance'),
                TextField::new('height')
                    ->setLabel('Taille'),
                TextField::new('weight')
                    ->setLabel('Poids'),
                DateField::new('joinedOn')
                    ->hideOnForm(),
        ];
    }

 
}
