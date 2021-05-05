<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_home")
     */
    public function index(UserInterface $user): Response
    {
        dump($user);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
