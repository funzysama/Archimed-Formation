<?php

namespace App\Controller;

use App\Repository\RessourceRepository;
use App\Repository\TestRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{

    /**
     * @Route("/index", name="index")
     */
    public function adminIndex(): Response
    {
        return $this->render('admin/index.html.twig');
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
        return $this->render('admin/listUser.html.twig', [
            'controller_name'   => 'AdminController',
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

        return $this->render('admin/listTest.html.twig', [
            'tests' => $tests
        ]);
    }

    /**
     * @Route("/ressources", name="ressources")
     */
    public function listerRessources(RessourceRepository $ressourceRepository): Response
    {
        $ressources = $ressourceRepository->findAll();

        return $this->render('admin/listRessources.html.twig', [
            'ressources' => $ressources
        ]);
    }

    public function userPreferences()
    {
        return $this->render('admin/userPreferences.html.twig');
    }

}
