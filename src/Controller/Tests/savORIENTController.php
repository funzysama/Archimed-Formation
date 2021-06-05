<?php


namespace App\Controller\Tests;


use App\Entity\I3pProfils;
use App\Entity\I3PResultat;
use App\Form\I3PType;
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
     * @return Response
     */
    public function testsavORIENT(Request $request, TestRepository $testRepository, QuestionRepository $questionRepository, I3pProfilsRepository $repository): Response
    {
        $questions = $questionRepository->findBy([
            'test' => $testRepository->findOneBy(['Nom' => 'savORIENT'])
        ]);
        $user = $this->getUser();
        $sexe = $user->getSexe();
        /*$form = $this->createForm(I3PType::class, null, [
            'questions' => $questions,
            'sexe'      => $sexe,
        ]);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();
            $calculator = new I3PCalculator($data, $repository);
            $resultat = $calculator->calculate();
            $i3presultat = $calculator->createResultat($resultat);
            $i3presultat->setUtilisateur($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($i3presultat);
            $em->flush();

            return $this->redirectToRoute('resultat', ['name' => 'I3P', 'id' => $i3presultat->getId()]);
        }*/
        return $this->render('test/savORIENT/test.html.twig', [
            'testName' => 'Positioning Skills',
            //'testForm' => $form->createView()
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