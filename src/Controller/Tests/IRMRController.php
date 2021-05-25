<?php


namespace App\Controller\Tests;


use App\Form\IRMRType;
use App\Repository\QuestionRepository;
use App\Repository\TestRepository;
use App\Service\IRMRCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IRMRController extends AbstractController
{
    /**
     * @param Request $request
     * @param TestRepository $testRepository
     * @param QuestionRepository $questionRepository
     * @return Response
     */
    public function testIRMR(Request $request, TestRepository $testRepository, QuestionRepository $questionRepository): Response
    {
        $questions = $questionRepository->findBy([
            'test' => $testRepository->findOneBy(['Nom' => 'IRMR'])
        ]);
        $user = $this->getUser();
        $sexe = $user->getSexe();
        $form = $this->createForm(IRMRType::class, null, [
            'questions' => $questions,
            'sexe'      => $sexe,
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();
            $calculator = new IRMRCalculator($data, $user);
            $resultat = $calculator->calculate();
            $result_chunk = array_chunk($resultat, 6, true);
            $labels = array_keys($result_chunk[0]);
            $data = array_values($result_chunk[0]);
            $etalData = array_values($result_chunk[1]);
            $diff = array_values($result_chunk[2]);

            return $this->forward('App\Controller\Tests\IRMRController::resultatIRMR', [
                'resultat' => $resultat,
                'labels' => $labels,
                'data' => $data,
                'etalData' => $etalData,
                'diff'  => $diff,
            ]);
        }
        return $this->render('test/IRMR/index.html.twig', [
            'testName' => 'Riasec Flash 2',
            'testForm' => $form->createView()
        ]);
    }

    /**
     * @param $resultat
     * @return Response
     */
    public function resultatIRMR($resultat, $labels, $data, $etalData, $diff): Response
    {
        return $this->render('test/IRMR/resultat.html.twig', [
            'resultat' => $resultat,
            'labels' => $labels,
            'data' => $data,
            'etalData' => $etalData,
            'diff'  => $diff,
        ]);
    }
}