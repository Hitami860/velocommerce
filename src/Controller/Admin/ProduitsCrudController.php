<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProduitsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('description'),
            IntegerField::new('prix'),
            TextField::new('categorie'),
            TextField::new('image'),
            AssociationField::new('categorie')
            ->setLabel('Catégorie')
            ->setFormTypeOptions([
                'by_reference' => false,
                'multiple' => false,  
            ])
            ->setRequired(true)
        ];
    }
    
}
