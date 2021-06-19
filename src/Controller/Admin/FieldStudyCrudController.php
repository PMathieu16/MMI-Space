<?php

namespace App\Controller\Admin;

use App\Entity\FieldStudy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FieldStudyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FieldStudy::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular("Domaine de poursuite d'étude")
            ->setEntityLabelInPlural("Domaines de poursuite d'étud");
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
