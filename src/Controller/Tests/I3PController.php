<?php


namespace App\Controller\Tests;


use App\Entity\I3pProfils;
use App\Entity\I3PResultat;
use App\Form\I3PType;
use App\Repository\I3pProfilsRepository;
use App\Repository\QuestionRepository;
use App\Repository\TestRepository;
use App\Service\I3PCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class I3PController extends AbstractController
{
    /**
     * @param Request $request
     * @param TestRepository $testRepository
     * @param QuestionRepository $questionRepository
     * @return Response
     */
    public function testI3P(Request $request, TestRepository $testRepository, QuestionRepository $questionRepository, I3pProfilsRepository $repository): Response
    {
        $questions = $questionRepository->findBy([
            'test' => $testRepository->findOneBy(['Nom' => 'I3P'])
        ]);
        $user = $this->getUser();
        $sexe = $user->getSexe();
        $form = $this->createForm(I3PType::class, null, [
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
            /*return $this->forward('App\Controller\Tests\I3PController::resultatI3P', [
                'resultat' => $i3presultat,
            ]);*/
        }
        return $this->render('test/I3P/index.html.twig', [
            'testName' => 'I3P',
            'testForm' => $form->createView()
        ]);
    }

    /**
     * @param $resultat
     * @return Response
     */
    public function resultatI3P(I3PResultat $resultat): Response
    {
        return $this->render('test/I3P/resultat.html.twig', [
            'resultat' => $resultat,
        ]);
    }
}