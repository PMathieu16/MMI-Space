<?php


namespace App\Controller;


use App\Data\SearchUser;
use App\Entity\User;
use App\Form\SearchUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GraduatesController extends AbstractController
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
     * @Route("/diplome", name="graduate.list")
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response{

        $search = new SearchUser();
        $search->page = $request->get('page', 1);
        $form = $this->createForm(SearchUserType::class, $search);
        $form->handleRequest($request);
        $graduates = $this->repository->findSearch($search);
        $nListe = count($graduates);

        return $this->render("pages/graduate/graduateList.html.twig", [
            'graduates' => $graduates,
            'nListe' => $nListe,
            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/diplome/{id}/{slug}", name="graduate.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param User $graduate
     * @param string $slug
     * @return Response
     */
    public function show(User $graduate,string $slug): Response{
        if($graduate->getSlug() !== $slug){
            return $this->redirectToRoute('graduate.show',[
                'id' => $graduate->getId(),
                'slug' => $graduate->getSlug(),
            ], 301);
        }

        return $this->render('pages/graduate/graduateShow.html.twig', [
            'graduate' => $graduate
        ]);
    }
}