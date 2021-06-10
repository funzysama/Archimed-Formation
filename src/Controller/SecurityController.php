<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ChangePassType;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
             return $this->redirectToRoute('main_home');
         }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/profil/{id}", name="monProfile")
     */
    public function monProfile(Utilisateur $user): Response
    {
        $i3pResultat = $user->getResultatI3P();
        $riasecResultat = $user->getResultatRiasec();
        $resultat = [];
        $resultat["i3P"] = null;
        $resultat["riasec"] = null;
        $resultat["positioning"] = null;
        if($i3pResultat){
            $resultat["i3P"] = $i3pResultat;
            dump($i3pResultat);
        }
        if($riasecResultat){
            $resultat["riasec"] = $riasecResultat;
        }
        return $this->render('security/monProfile.html.twig', [
            'user'      => $user,
            'resultats'  => $resultat
        ]);
    }

    /**
     * @Route("/profile/{id}/tests", name="mesTests")
     */
    public function mesTests(Utilisateur $user): Response
    {
        return $this->render('security/mesTests.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/profile/{id}/resultats", name="mesResultat")
     */
    public function mesResultats(Utilisateur $user): Response
    {
        $resultat = $user->getI3PResultats();
        return $this->render('security/mesResultats.html.twig', [
            'user' => $user,
            'resultat'  => $resultat
        ]);
    }


    /**
     * @Route("/security/changePass", name="security_changePass")
     */
    public function changePassword(UserPasswordEncoderInterface $passwordEncoder, Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePassType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            if($form->isValid()){
                $password = $form->get('Password')->getData();
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $password
                    )
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('succes', 'c\'est goood !');

                return $this->RedirectToRoute('app_logout');

            }
        }

        return $this->render('security/firstChangePass.html.twig', [
            'user'              => $user,
            'changePassForm'    => $form->createView()
        ]);
    }
    /**
     * @Route("/PasswordUpdate/{id}", name="security_firstChangePass")
     */
    public function firstChangePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, UtilisateurRepository $userRepository, $id): Response
    {
        $user = $this->getUser();
        if(!$user){
            $user = $userRepository->find($id);
        }
        $form = $this->createForm(ChangePassType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            if($form->isValid()){
                $password = $form->get('Password')->getData();
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $password
                    )
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('succes', 'c\'est goood !');

                return $this->RedirectToRoute('app_logout');

            }
        }

        return $this->render('security/firstChangePass.html.twig', [
            'user'              => $user,
            'changePassForm'    => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
