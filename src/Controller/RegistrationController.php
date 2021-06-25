<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Repository\ModuleRepository;
use App\Repository\TestRepository;
use App\Security\EmailVerifier;
use App\Repository\UtilisateurRepository;
use App\Service\PasswordGenerator;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/admin/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param PasswordGenerator $passwordGenerator
     * @param ModuleRepository $moduleRepository
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, PasswordGenerator $passwordGenerator, ModuleRepository $moduleRepository): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $entityManager = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if($form->isSubmitted() && !$form->isValid()){
            return $this->render('registration/register.html.twig', [
                'registrationForm' => $form->createView(),
                'error' => true
            ]);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            if(in_array('ROLE_ADMIN', $this->getUser()->getRoles())){
                $role = array($form->get('role')->getData());
                $consultant = $form->get('consultant')->getData();
            }else{
                $role = ["ROLE_USER"];
                $consultant = $this->getUser();
            }
            if($role !== ["ROLE_USER"]){
                $module = $moduleRepository->find(1);
                $user->setModule($module);
                $randomPass = 'password';
                $user->setIsVerified(true);
                $user->setAuthResultI3P(true);
                $user->setAuthResultRiasec(true);
                $user->setAuthResultPositioning(true);
            }else{
                $randomPass = $passwordGenerator->generateRandomStrongPassword();
                $consultant->addClient($user);
                $entityManager->persist($consultant);
                $module = $form->get('module')->getData();
                $user->setConsultant($consultant);
                $user->setModule($module);
            }
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $randomPass
                )
            );
            $user->setActif(true);
            $user->setRoles($role);
            $entityManager->persist($user);
            $entityManager->flush();
            if($role === ["ROLE_USER"]){
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('no-reply@archi-med.fr', 'Archi-Med'))
                        ->to($user->getEmail())
                        ->subject('Merci de confirmer votre e-mail')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                        ->context(['password' => $randomPass])
                );
            }
            $this->addFlash('success', 'Vous avez enregistré un nouvel utilisateur, un email lui a été envoyer pour activer son compte.');

            return $this->redirectToRoute('main_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     * @param Request $request
     * @param UtilisateurRepository $utilisateurRepository
     * @return Response
     */
    public function verifyUserEmail(Request $request, UtilisateurRepository $utilisateurRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $utilisateurRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        if($user->isVerified()){
            return $this->RedirectToRoute('security_firstChangePass', ['id' => $id]);
        }
        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());
            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Succes ! Votre compte est vérifié, veuillez changer votre Mot de passe');

        return $this->RedirectToRoute('security_firstChangePass', ['id' => $id]);
    }
}
