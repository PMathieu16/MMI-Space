<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{

    /**
     * @Route("/entreprise", name="company")
     */
    public function index(): Response{
        $companies = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAllCompany()
        ;


        return $this->render('pages/company.html.twig',[
            "companies" => $companies
        ]);

    }
}