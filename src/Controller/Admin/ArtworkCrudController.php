<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArtworkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artwork::class;
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
