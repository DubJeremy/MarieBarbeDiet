<?php

namespace App\Controller\Admin;

use App\Entity\UserCategory;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserCategory::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('userCategory'),
        ];
    }
}
