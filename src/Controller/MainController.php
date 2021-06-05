<?php

namespace App\Controller;

use App\Repository\MetierPERepository;
use App\Repository\RessourceRepository;
use App\Repository\TestRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

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
        $user = $this->getUser();
        $module = $user->getModule();
        dump($module);
        if($module->getId() > 0 && $module->getId() <= 7){
            $folderAccess = "bc";
        }else{
            $folderAccess = "vae";
        }
        if($user->hasRoles('ROLE_ADMIN')){
            $folderAccess = "main";
            dump($folderAccess);
        }
        return $this->render('main/index.html.twig', [
            'folderAccess' => $folderAccess
        ]);
    }

    /**
     * @Route("/utilisateurs", name="users")
     */
    public function listerUtilisateurs(UtilisateurRepository $utilisateurRepository): Response
    {
        $users = $utilisateurRepository->findAll();
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
