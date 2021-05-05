<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_users")
     */
    public function listerUtilisateurs(UtilisateurRepository $utilisateurRepository): Response
    {
        $users = $utilisateurRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name'   => 'AdminController',
            'users'             => $users
        ]);
    }
}
