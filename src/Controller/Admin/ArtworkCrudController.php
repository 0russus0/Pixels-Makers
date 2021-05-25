<?php

namespace App\Controller\Admin;

use App\Entity\Artwork;
use App\Form\AttachmentType;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
        $imageFile = TextField::new('imagePrincipale')->setFormType(VichImageType::class)->setTranslationParameters(['form.label.delete'=>'Supprimer?']);
        $image = ImageField::new('image1')->setBasePath('/uploads/images');


        $fields = [

            //ChoiceField::new('type'),
            TextField::new('titre'),
            TextField::new('slug')->hideOnForm(),
            //TextEditorField::new('contenu'), Si Admin
            TextField::new('contenu'),
            AssociationField::new('user')->hideOnForm(),
            DateField::new('date_create')->hideOnForm(),
            AssociationField::new('category')->setLabel('Catégorie')->onlyOnForms(),
            ChoiceField::new('type')->setChoices(['Artwork'=>1,'Article'=>2]),
            TextField::new('file')->onlyOnForms(),  
            BooleanField::new('shared'),
            BooleanField::new('gallery'), 
            CollectionField::new('attachments')
            ->setLabel('Ajouter des images')
            ->setEntryType(AttachmentType::class)
            ->setTranslationParameters(['form.label.delete'=>'Supprimer?'])
            ->onlyOnForms(),
            

        ];
        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL) {
            $fields[] = $image;
        } else {
            $fields[] = $imageFile;
        }
        return $fields;
    }
//configuration du CRUD
    public function configureCrud(Crud $crud): Crud
    {
//tri des dates de création plus rescent au plus ancien
        return $crud
        ->setDefaultSort(['date_create' => 'DESC']);
    }
}
