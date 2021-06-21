<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('profilPicture')
                ->setBasePath($this->getParameter("app.path.product_images"))
                ->onlyOnIndex()
            ,
            TextareaField::new('profilPictureFile', "profilPicture")
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->setFormTypeOption('allow_delete',false),
            TextField::new('fullName'),
            TextField::new('email'),
            AssociationField::new('userCategory')->hideOnForm(),
            DateField::new('age'),
            TextField::new('height'),
            TextField::new('weight'),
            DateField::new('joinedOn')->hideOnForm(),
        ];
    }

 
}
