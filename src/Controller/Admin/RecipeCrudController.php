<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            ImageField::new('picture')
                ->setBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex()
                ->setLabel('Photo de plat')
                ,
            TextareaField::new('pictureFile', "image")
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->setFormTypeOption('allow_delete',true),
            AssociationField::new('userCategory'),
            TextareaField::new('recipe'),
            TextareaField::new('ingredient'),
            AssociationField::new('difficulty'),
            TimeField::new('preparationTime'),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC']);
    }
}
