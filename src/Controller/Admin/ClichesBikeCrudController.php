<?php

namespace App\Controller\Admin;

use App\Entity\ClichesBike;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClichesBikeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClichesBike::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('auteur'),
            TextField::new('image'),
            TextField::new('description'),
        ];
    }
    
}
