<?php

namespace App\Controller\Admin;


use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setEntityLabelInSingular("Utilisateur")
            ->setEntityLabelInPlural("Utilisateurs");
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstName','Prénom'),
            TextField::new('lastName','Nom'),
            EmailField::new('email', 'Email')
                ->hideOnForm(),
            IntegerField::new('promo','Promo / Année'),
            ChoiceField::new('roles',"Rôles")
                ->setChoices([
                    "Utilisateur" => "ROLE_USER",
                    "Administrateur" => "ROLE_ADMIN",
                ])
                ->renderExpanded(false)
                ->allowMultipleChoices(true),
            AssociationField::new('bac',"Bac d'origine")
                ->onlyOnForms(),
            BooleanField::new('isEduc',"Membre de l'équipe pédagogique"),
            ImageField::new('imageName','Image')
                ->setBasePath("/data/img/user")
                ->setUploadDir('public/data/img/user')
                ->setUploadedFileNamePattern(uniqid(rand()) . ".[extension]")
                ->setRequired(false),
            UrlField::new('portfolio','Portfolio')
                ->onlyOnForms(),
            UrlField::new('linkedin','LinkedIn')
                ->onlyOnForms(),
            UrlField::new('behance','Behance')
                ->onlyOnForms(),
            UrlField::new('instagram','Instagram')
                ->onlyOnForms(),
            UrlField::new('facebook','Facebook')
                ->onlyOnForms(),
            AssociationField::new('fieldStudy', "Domaine de poursuite d'étude")
                ->onlyOnForms(),
            ChoiceField::new('bestDegree',"Le plus haut niveau d'étude")
                ->setChoices([
                    'Bac +2'=>'Bac +2',
                    'Bac +3'=>'Bac +3',
                    'Bac +4'=>'Bac +4',
                    'Bac +5'=>'Bac +5',
                    'Bac +6'=>'Bac +6',
                    'Bac +7'=>'Bac +7',
                    'Bac +8'=>'Bac +8',
                ])
                ->onlyOnForms(),
            AssociationField::new('fieldActivity', "Domaine d'activité")
                ->onlyOnForms(),
            TextField::new('job','Métier')
                ->onlyOnForms(),
            ChoiceField::new('curStatus',"Situation actuelle")
                ->setChoices([
                    'CDD'=>'CDD',
                    'CDI'=>'CDI',
                    'Sans emploi'=>'Sans emploi',
                ])
                ->onlyOnForms(),
            AssociationField::new('salary',"Salaire")
                ->onlyOnForms(),
            TextField::new('company',"Entreprise")
                ->onlyOnForms(),
            TextField::new('zoneActivity', "Lieu d'activité")
                ->onlyOnForms(),
            TextField::new('status',"Statut")
                ->onlyOnForms(),
            TextareaField::new('description',"Description")
                ->onlyOnForms(),




        ];
    }
}
