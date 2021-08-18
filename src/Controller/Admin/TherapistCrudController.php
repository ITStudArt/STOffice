<?php

namespace App\Controller\Admin;

use App\Entity\Therapist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TherapistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Therapist::class;
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
