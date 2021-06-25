<?php

namespace App\Controller;

use App\Form\PresentationType;
use App\Repository\PresentationRepository;
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
     * @param PresentationRepository $presentationRepository
     * @return Response
     */
    public function gestionI3P(PresentationRepository $presentationRepository): Response
    {
        $test = $this->testRepository->findOneBy(['Nom' => 'I3P']);
        $presentation = $test->getPresentation();

        $formEditPrez = $this->createForm(PresentationType::class, $presentation);
        if($formEditPrez->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($presentation);
            $em->flush();
            return $this->redirectToRoute('admin_gestion_i3p', [
                'form'  => $formEditPrez->createView()
            ]);
        }

        return $this->render('/admin/gestioni3p.html.twig', [
            'test' => $test,
            'form'  => $formEditPrez->createView()
        ]);
    }

    /**
     * @Route("/gestion/Riasec", name="gestion_riasec")
     */
    public function gestionRiasec(): Response
    {
        $test = $this->testRepository->findOneBy(['Nom' => 'IRMR']);

        $presentation = $test->getPresentation();

        $formEditPrez = $this->createForm(PresentationType::class, $presentation);
        if($formEditPrez->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($presentation);
            $em->flush();
            return $this->redirectToRoute('admin_gestion_riasec', [
                'form' => $formEditPrez->createView()
            ]);
        }
        return $this->render('/admin/gestionriasec.html.twig', [
            'test' => $test,
            'form'  => $formEditPrez->createView()
        ]);

    }
}
