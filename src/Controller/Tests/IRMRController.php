<?php


namespace App\Controller\Tests;


use App\Form\IRMRType;
use App\Repository\QuestionRepository;
use App\Repository\TestRepository;
use App\Service\IRMRCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            $em = $this->getDoctrine()->getManager();
            $em->persist($resultat);
            $em->flush();
            return $this->forward('App\Controller\Tests\IRMRController::resultatIRMR', [
                'resultat'              => $resultat,
            ]);
        }
        return $this->render('test/IRMR/test.html.twig', [
            'testName' => 'R.i.a.s.e.c.',
            'testForm' => $form->createView()
        ]);
    }

    /**
     * @param $resultat
     * @return Response
     */
    public function resultatIRMR($resultat): Response
    {
        $orderedPourcent = [];
        $orderedPourcent["Realiste"] = $resultat->getRealistePourcent();
        $orderedPourcent["Investigateur"] = $resultat->getInvestigateurPourcent();
        $orderedPourcent["Artiste"] = $resultat->getArtistePourcent();
        $orderedPourcent["Social"] = $resultat->getSocialPourcent();
        $orderedPourcent["Entrepreneur"] = $resultat->getEntrepreneurPourcent();
        $orderedPourcent["Conventionnel"] = $resultat->getConventionnelPourcent();
        arsort($orderedPourcent);
        $minor1 = '';
        $minor2 = '';
        if(strlen($resultat->getMineur()) > 14){
            $twoMineur = true;
            $minors = preg_split('/ - /', $resultat->getMineur());
            $minor1 = $minors[0];
            $minor2 = $minors[1];
        }else{
            $twoMineur = false;
        }
        $calculator = new IRMRCalculator($resultat, $this->getUser());
        $resultat = $calculator->getConsistance($resultat);
        return $this->render('test/IRMR/resultat.html.twig', [
            'resultat'              => $resultat,
            'orderedPourcent'       => $orderedPourcent,
            'twoMineur'             => $twoMineur,
            'minor1'                => $minor1,
            'minor2'                => $minor2
        ]);
    }

    /**
     * @return Response
     * @Route("/Riasec", name="presentation_Riasec")
     */
    public function presentationRiasec(TestRepository $repository): Response
    {
        $test = $repository->findOneBy(['Nom' => 'IRMR']);

        return $this->render('test/IRMR/index.html.twig', [
            'testName'  => 'R.i.a.s.e.c.',
            'test'      => $test
        ]);
    }

    /**
     * @return Response
     * @Route("/Riasec/apercu", name="apercu_Riasec")
     */
    public function apercuRiasec(TestRepository $repository): Response
    {
        $test = $repository->findOneBy(['Nom' => 'IRMR']);

        return $this->render('test/aperçu.html.twig', [
            'testName'  => 'R.i.a.s.e.c.',
            'test'      => $test
        ]);
    }

}