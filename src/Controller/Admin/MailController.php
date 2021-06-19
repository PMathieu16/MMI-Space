<?php


namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\MailType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MailController extends AbstractController
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    private $mailer;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param MailerInterface $mailer
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    /**
     * @Route ("/admin/mail", name="mail")
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function new(Request $request): Response{

        $form = $this->createForm(MailType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789" ;
            $ref = substr(str_shuffle($chars),0 ,8 );

            $user->setPassword($this->passwordEncoder->encodePassword($user,$ref));
            $user->setEmail($form["email"]->getData());
            $user->setIsEduc($form["isEduc"]->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $email = (new TemplatedEmail())
                ->from('mmispace@unilim.fr')
                ->to($form["email"]->getData())
                ->subject("MMI Space")
                ->embedFromPath('data/img/others/astronaute.png','Astronaute')
                ->htmlTemplate('security/mailTemplate.html.twig')
                ->context([
                    'id' => $form["email"]->getData(),
                    'passwd' => $ref,
                ])
            ;

            $this->mailer->send($email);


        }

        return $this->render('security/mail.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}