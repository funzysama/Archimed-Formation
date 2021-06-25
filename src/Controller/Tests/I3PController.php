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
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            if($user->getAuthResultI3P()){
                return $this->redirectToRoute('resultat', ['name' => 'I3P', 'id' => $i3presultat->getId()]);
            }else{
                $this->addFlash('success', 'Vos résultats ont bien été enregistrés, votre consultant reviendra vers vous pour vous les communiquer. ');
                return $this->redirectToRoute('main_home');

            }

        }
        return $this->render('test/I3P/test.html.twig', [
            'testName' => 'I3P',
            'testForm' => $form->createView()
        ]);
    }

    /**
     * @param I3PResultat $resultat
     * @param pdfDataFormatter $dataFormatter
     * @return Response
     */
    public function resultatI3P(I3PResultat $resultat, pdfDataFormatter $dataFormatter)
    {

        $profil = $resultat->getProfil();
        $resultatArrayForPdf = $dataFormatter->convertI3PResultat($resultat, $profil);
        $jsonResult = json_encode($resultatArrayForPdf, JSON_UNESCAPED_SLASHES);
        $valeurs = preg_split('/\s\|\s/', $profil->getValeurs());

        return $this->render('test/I3P/resultat.html.twig', [
            'resultat' => $resultat,
            'jsonResultat' => $jsonResult,
            'valeurs' => $valeurs
        ]);
    }

    /**
     * @Route("/result/{id}/pdf", name="resultat_i3p_pdf")
     * @param I3PResultat $resultat
     * @param pdfDataFormatter $dataFormatter
     */
    public function resultatI3PPDF(I3PResultat $resultat, pdfDataFormatter $dataFormatter)
    {
        $pdfOptions = new Options();
        $pdfOptions->set([
            'isHtml5ParserEnabled' => true
        ]);
        $dompdf = new Dompdf($pdfOptions);

        $profil = $resultat->getProfil();
        $valeurs = preg_split('/\s\|\s/', $profil->getValeurs());
        $html = $this->renderView('test/I3P/resultat_pdf.html.twig', [
            'resultat' => $resultat,
            'valeurs' => $valeurs
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->outputHtml();
        $dompdf->stream('mon-profil-I3P.pdf', [
            "Attachement"   => false
        ]);

    }


    /**
     * @return Response
     * @Route("/i3P", name="presentation_I3P")
     */
    public function presentationi3p(TestRepository $repository): Response
    {
        $test = $repository->findOneBy(['Nom' => 'I3P']);

        return $this->render('test/I3P/index.html.twig', [
            'testName'  => 'I3P',
            'test'      => $test
        ]);
    }

    /**
     * @return Response
     * @Route("/i3P/apercu", name="apercu_I3P")
     */
    public function apercui3p(TestRepository $repository): Response
    {
        $test = $repository->findOneBy(['Nom' => 'I3P']);

        return $this->render('test/aperçu.html.twig', [
            'testName'  => 'I3P',
            'test'      => $test
        ]);
    }
}