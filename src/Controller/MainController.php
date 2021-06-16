<?php

namespace App\Controller;

use App\Repository\RessourceRepository;
use App\Repository\TestRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="main_")
 */
class MainController extends AbstractController
{

    /**
     * @Route("/index", name="home")
     */
    public function adminIndex(): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/utilisateurs", name="users")
     */
    public function listerUtilisateurs(UtilisateurRepository $utilisateurRepository): Response
    {
        $user = $this->getUser();
        if($user->hasRoles('ROLE_ADMIN')){
            $users = $utilisateurRepository->findAll();
        }else{
            $users = $this->getUser()->getClients()->getSnapshot();
        }
        $jsonUsers = [];
        foreach($users as $user) {
            array_push($jsonUsers, $user->toArray());
        }
        return $this->render('main/listUser.html.twig', [
            'controller_name'   => 'mainController',
            'users'             => $users,
            'jsonUsers'         => $jsonUsers
        ]);
    }

    /**
     * @Route("/tests", name="tests")
     */
    public function listerTests(TestRepository $testRepository): Response
    {
        $tests = $testRepository->findAll();

        return $this->render('main/listTest.html.twig', [
            'tests' => $tests
        ]);
    }

    /**
     * @Route("/ressources", name="ressources")
     */
    public function listerRessources(RessourceRepository $ressourceRepository): Response
    {
        $ressources = $ressourceRepository->findAll();

        return $this->render('main/listRessources.html.twig', [
            'ressources' => $ressources
        ]);
    }

    public function userPreferences()
    {
        return $this->render('main/userPreferences.html.twig');
    }

}
