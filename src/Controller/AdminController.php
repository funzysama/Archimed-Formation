<?php

namespace App\Controller;

use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    private $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    /**
     * @Route("/gestion/i3p", name="gestion_i3p")
     */
    public function gestionI3P(): Response
    {
        $test = $this->testRepository->findOneBy(['Nom' => 'I3P']);

        return $this->render('/admin/gestioni3p.html.twig', [
            'test' => $test,
        ]);
    }

    /**
     * @Route("/gestion/Riasec", name="gestion_riasec")
     */
    public function gestionRiasec(): Response
    {
        $test = $this->testRepository->findOneBy(['Nom' => 'IRMR']);

        return $this->render('/admin/gestionRiasec.html.twig', [
            'test' => $test,
        ]);
    }
}
