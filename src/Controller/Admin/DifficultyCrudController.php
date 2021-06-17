<?php

namespace App\Controller\Admin;

use App\Entity\Difficulty;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DifficultyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Difficulty::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
