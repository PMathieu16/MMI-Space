<?php

namespace App\Controller\Admin;

use App\Entity\FieldActivity;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FieldActivityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FieldActivity::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular("Domaine d'activité")
            ->setEntityLabelInPlural("Domaines d'activité");
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('name'),
        ];
    }
}
