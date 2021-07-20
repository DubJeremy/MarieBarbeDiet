<?php

namespace App\Controller\Admin;

use App\Entity\RecipePost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecipePostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RecipePost::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title')
                ->onlyOnIndex(),
            TextField::new('titleR')
                ->hideOnIndex()
                ->setLabel('Titre Recette'),
            TextField::new('titleP')
                ->hideOnIndex()
                ->setLabel('Titre Post'),
            ImageField::new('picture')
                ->setBasePath('images/media')
                ->onlyOnIndex()
                ->setLabel('Photo de plat'),
            TextField::new('pictureFile')
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->setLabel('Image')
                ->setFormTypeOption('allow_delete',true),
            AssociationField::new('userCategory'),
            TextareaField::new('contenu')
                ->onlyOnIndex(),
            TextareaField::new('content')
                ->hideOnIndex()
                ->setLabel('Contenu Post'),
            TextareaField::new('recipe')
                ->hideOnIndex()
                ->setLabel('Recette'),
            TextareaField::new('ingredient'),
            AssociationField::new('difficulty'),
            TimeField::new('preparationTime'),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPageTitle(Crud::PAGE_INDEX, 'Recettes');
    }
}
