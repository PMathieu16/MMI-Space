<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class homeController extends AbstractController
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index(Security $security): Response{

        if($security->isGranted('IS_AUTHENTICATED_FULLY')){
            return new RedirectResponse($this->urlGenerator->generate('article.list'));
        }
        return $this->render("pages/home.html.twig");
    }

}