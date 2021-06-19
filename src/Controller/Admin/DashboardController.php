<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Bac;
use App\Entity\FieldActivity;
use App\Entity\FieldStudy;
use App\Entity\Offer;
use App\Entity\Salary;
use App\Entity\User;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {

        $allUser = $this->repository->findAll();

        $count = count($allUser);
        $bac = $this->bac($allUser);
        $promo = $this->promo($allUser);
        $degree = $this->degree($allUser);
        $curStatus = $this->curStatus($allUser);
        $salary = $this->salary($allUser);

        return $this->render('security/stats.html.twig',[
            "count" => $count,
            "bac" => $bac,
            "promo" => $promo,
            "degree" => $degree,
            "curStatus" => $curStatus,
            "salary" => $salary
        ]);
    }

    /**
     * @param $allUser
     * @return array
     */
    public  function bac($allUser): array
    {
        $tmp= [];

        foreach($allUser as $user){
            if($user->getBac() != null && $user->getIsEduc() != true){
                array_push($tmp,$user->getBac()->getName());
            }
        }

        $tmp = array_count_values($tmp);
        $name = array_keys($tmp);

        $bac = [];

        foreach ($name as $n){
            $x = array(
                "name" => $n,
                "count" => $tmp[$n]
            );

            array_push($bac,$x);
        }

        return $bac;
    }

    /**
     * @param $allUser
     * @return array
     */
    public  function promo($allUser): array
    {
        $tmp= [];

        foreach($allUser as $user){
            if($user->getPromo() != null && $user->getIsEduc() != true){
                array_push($tmp, $user->getPromo());
            }
        }

        $tmp = array_count_values($tmp);
        $name = array_keys($tmp);

        $promo = [];

        foreach ($name as $n){
            $x = array(
                "name" => $n,
                "count" => $tmp[$n]
            );
            array_push($promo,$x);
        }

        sort($promo);
        return $promo;
    }

    /**
     * @param $allUser
     * @return array
     */
    public  function degree($allUser): array
    {
        $tmp= [];

        foreach($allUser as $user){
            if($user->getBestDegree() != null && $user->getIsEduc() != true){
                array_push($tmp, $user->getBestDegree());
            }
        }

        $tmp = array_count_values($tmp);
        $name = array_keys($tmp);

        $degree = [];

        foreach ($name as $n){
            $x = array(
                "name" => $n,
                "count" => $tmp[$n]
            );
            array_push($degree,$x);
        }

        sort($degree);
        return $degree;
    }

    /**
     * @param $allUser
     * @return array
     */
    public  function curStatus($allUser): array
    {
        $tmp= [];

        foreach($allUser as $user){
            if($user->getCurStatus() != null && $user->getIsEduc() != true){
                array_push($tmp, $user->getCurStatus());
            }
        }

        $tmp = array_count_values($tmp);
        $name = array_keys($tmp);

        $curStatus = [];

        foreach ($name as $n){
            $x = array(
                "name" => $n,
                "count" => $tmp[$n]
            );
            array_push($curStatus,$x);
        }

        return $curStatus;
    }

    /**
     * @param $allUser
     * @return array
     */
    public  function salary($allUser): array
    {
        $tmp= [];

        foreach($allUser as $user){
            if($user->getSalary() != null && $user->getIsEduc() != true){
                array_push($tmp, $user->getSalary()->getName());
            }
        }

        $tmp = array_count_values($tmp);
        $name = array_keys($tmp);

        $salary = [];

        foreach ($name as $n){
            $x = array(
                "name" => $n,
                "count" => $tmp[$n]
            );
            array_push($salary,$x);
        }

        sort($salary);
        return $salary;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<a href="https://mmispace.mathieu-parinet.fr">MMI Space</a>')
            ->setFaviconPath('data/img/others/accueil.png')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Articles', 'far fa-newspaper', Articles::class);
        yield MenuItem::linkToCrud("Offres d'emploi", 'fas fa-file-signature', Offer::class);

        yield MenuItem::section("Utilisateurs");
        yield MenuItem::linkToCrud("Liste","fa fa-users",User::class);
        yield MenuItem::linkToCrud("Bac d'origine","fa fa-graduation-cap", Bac::class);
        yield MenuItem::linkToCrud("Domaine de poursuite d'étude", "fas fa-university", FieldStudy::class);
        yield MenuItem::linkToCrud("Domaine d'activité", "fas fa-layer-group", FieldActivity::class);
        yield MenuItem::linkToCrud("Salaire","fas fa-euro-sign", Salary::class);
        yield MenuItem::linkToRoute('Inviter','fa fa-user-plus',"mail");
    }
}
