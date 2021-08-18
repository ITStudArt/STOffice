<?php

namespace App\Controller\Admin;

use App\Entity\Exercises;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExercisesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercises::class;
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
