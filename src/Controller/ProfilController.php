<?php


namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * ProfilController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/profil",name="profil")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response{

        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($form['password']->getData() != null){
                $user->setPassword($this->passwordEncoder->encodePassword($user,$form['password']->getData()));
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }

        return $this->render('pages/profil.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);

    }
}