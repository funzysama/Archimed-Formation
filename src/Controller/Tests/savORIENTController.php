<?php


namespace App\Controller\Tests;


use App\Entity\I3pProfils;
use App\Entity\I3PResultat;
use App\Entity\Question;
use App\Entity\SavOrientFormResult;
use App\Form\I3PType;
use App\Form\savORIENTFlowType;
use App\Repository\I3pProfilsRepository;
use App\Repository\QuestionRepository;
use App\Repository\TestRepository;
use App\Service\I3PCalculator;
use App\Service\pdfDataFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class savORIENTController extends AbstractController
{
    /**
     * @param Request $request
     * @param TestRepository $testRepository
     * @param QuestionRepository $questionRepository
     * @param savORIENTFlowType $flow
     * @return Response
     */
    public function testsavORIENT(Request $request, TestRepository $testRepository, QuestionRepository $questionRepository, savORIENTFlowType $flow): Response
    {
        $questions = $questionRepository->findBy([
            'test' => $testRepository->findOneBy(['Nom' => 'savORIENT'])
        ]);
        $user = $this->getUser();
        $sexe = $user->getSexe();
        $formData = [];
        $flow->bind($formData);

        $flow->setGenericFormOptions(['questions' => $questions, 'sexe' => $sexe]);
        $form = $flow->createForm();
        $dm = $flow->getDataManager();

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                $form = $flow->createForm();
            } else {
                $data = $dm->load($flow);
                dump($data);

                $flow->reset(); // remove step data from the session

//                return $this->redirect($this->generateUrl('home')); // redirect when done
            }
        }

        return $this->render('test/savORIENT/test.html.twig', [
            'testName'  => 'Positioning Skills',
            'testForm'  => $form->createView(),
            'flow'      => $flow
        ]);
    }

/*    /**
     * @param $resultat
     * @return Response
     *
    public function resultatsavORIENT(I3PResultat $resultat, pdfDataFormatter $dataFormatter): Response
    {

        $profil = $resultat->getProfil();
        $resultatArrayForPdf = $dataFormatter->convertI3PResultat($resultat, $profil);
        $jsonResult = json_encode($resultatArrayForPdf, JSON_UNESCAPED_SLASHES);
        return $this->render('test/I3P/resultat.html.twig', [
            'resultat' => $resultat,
            'jsonResultat' => $jsonResult
        ]);
    }
*/
    /**
     * @return Response
     * @Route("/savORIENT", name="presentation_savORIENT")
     */
    public function presentationsavORIENT(TestRepository $repository): Response
    {
        $test = $repository->findOneBy(['Nom' => 'savORIENT']);

        return $this->render('test/savORIENT/index.html.twig', [
            'testName'  => 'Positioning Skills',
            'test'      => $test
        ]);
    }
}