<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_USER')]
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
            TextEditorField::new('contenu'),
            AssociationField::new('user')->hideOnForm(),
            DateField::new('date_create')->hideOnForm(),
            AssociationField::new('category')->setLabel('Catégorie'),
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
