<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class ArtworkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artwork::class;
    }

//configuration des champs 
    public function configureFields(string $pageName): iterable
    {
        return [

            //ChoiceField::new('type'),
            TextField::new('titre'),
            TextField::new('slug')->hideOnForm(),
            TextareaField::new('contenu'),
            DateField::new('date_create')->hideOnForm(),
            TextField::new('image1'),
            ChoiceField::new('type')->setChoices(['Artwork'=>1,'Article'=>2]),
            TextField::new('file'),  
            BooleanField::new('shared'),
            BooleanField::new('gallery'),         
            // en attendant d'utiliser visch et ImageField
        ];
    }
//configuration du CRUD
    public function configureCrud(Crud $crud): Crud
    {
//tri des dates de création plus rescent au plus ancien
        return $crud
        ->setDefaultSort(['date_create' => 'DESC']);
    }
}
