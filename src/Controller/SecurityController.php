<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\ChangeEmailType;
use App\Form\ChangePassType;
use App\Form\RegistrationFormType;
use App\Repository\UtilisateurRepository;
use http\Exception\BadQueryStringException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
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
     * @param Utilisateur $user
     * @return Response
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
     * @Route("/profil/view/{id}", name="viewProfile")
     * @param Utilisateur $user
     * @return Response
     */
    public function viewProfile(Utilisateur $user): Response
    {
        $i3pResultat = $user->getResultatI3P();
        $riasecResultat = $user->getResultatRiasec();
        $resultat = [];
        $resultat["i3P"] = null;
        $resultat["riasec"] = null;
        $resultat["positioning"] = null;
        if($i3pResultat){
            $resultat["i3P"] = $i3pResultat;
        }
        if($riasecResultat){
            $resultat["riasec"] = $riasecResultat;
        }
        return $this->render('security/viewProfile.html.twig', [
            'user'      => $user,
            'resultats'  => $resultat
        ]);
    }

    /**
     * @Route("/user/edit/{id}")
     * @param Request $request
     * @param Utilisateur $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editUser(Request $request, Utilisateur $user)
    {
        if($user){
            $form = $this->createForm(RegistrationFormType::class, $user);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('main_users');
            }

            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(),
                'user'             => $user
            ]);
        }else{
            throw new NotFoundResourceException("Cet utilisateur n'existe pas.", 404);
        }
    }

    /**
     * @Route("/user/delete/{id}")
     * @param Utilisateur $user
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteUser(Utilisateur $user)
    {
        if($user){

            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            return $this->json('ok !');
        }else{
            throw new NotFoundResourceException("Cet utilisateur n'existe pas.", 404);
        }
    }

    /**
     * @Route("/security/changePass", name="security_changePass")
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param Request $request
     * @return Response
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
     * @Route("/security/changeEmail", name="security_changeEmail")
     * @param Request $request
     * @return Response
     */
    public function changeEmail(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangeEmailType::class);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            if($form->isValid()){
                $email = $form->get('Email')->getData();
                $user->setEmail($email);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('succes', 'c\'est goood !');

                return $this->RedirectToRoute('app_logout');

            }
        }

        return $this->render('security/ChangeEmail.html.twig', [
            'user'              => $user,
            'changeEmailForm'    => $form->createView()
        ]);
    }

    /**
     * @Route("/PasswordUpdate/{id}", name="security_firstChangePass")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UtilisateurRepository $userRepository
     * @param $id
     * @return Response
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
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/switchActif", methods="POST")
     * @param Request $request
     * @param UtilisateurRepository $repository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function switchActif(Request $request, UtilisateurRepository $repository)
    {
        $email = $request->get('email');
        $user = $repository->findOneBy(["email" => $email]);
        if($user->getActif() === false){
            $user->setActif(true);
        }else{
            $user->setActif(false);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->json('Ok');
    }

}
