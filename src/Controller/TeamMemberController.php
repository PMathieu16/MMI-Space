<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamMemberController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * TeamMemberController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Response
     * @Route("/equipe-pedagogique", name="teamMember.list")
     */
    public function list(): Response{
        $teamMembers = $this->repository->findBy(array("isEduc"=>true));

        return $this->render("pages/teamMemberList.html.twig", [
            'teamMembers' => $teamMembers
        ]);
    }
}