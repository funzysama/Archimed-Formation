<?php


namespace App\Controller\Tests;


use App\Entity\IrmrResultat;
use App\Form\IRMRType;
use App\Repository\QuestionRepository;
use App\Repository\TestRepository;
use App\Service\IRMRCalculator;
use App\Service\pdfDataFormatter;
use Dompdf\Css\Style;
use Dompdf\Css\Stylesheet;
use Dompdf\Dompdf;
use Dompdf\Options;
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
            if($user->getAuthResultRiasec()){
                return $this->forward('App\Controller\Tests\IRMRController::resultatIRMR', [
                    'resultat'              => $resultat,
                ]);
            }else{
                $this->addFlash('success', 'Vos résultats ont bien été enregistrés, votre consultant reviendra vers vous pour vous les communiquer. ');
                return $this->redirectToRoute('main_home');

            }
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
    public function resultatIRMR(IrmrResultat $resultat): Response
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
     * @Route("/result/Riasec/{id}/pdf", name="resultat_irmr_pdf", methods={"POST","GET"})
     * @param IrmrResultat $resultat
     */
    public function resultatIRMRPDF(Request $request, IrmrResultat $resultat)
    {
        if($request->isMethod('POST')){
            $data = $request->request->all();
            $image64 = json_decode($data["image"]);
        }else{
            $image64 = "";
        }

        $pdfOptions = new Options();
        $pdfOptions->set([
            'isHtml5ParserEnabled'  => true,
            'isRemoteEnabled'       => true
        ]);

        $dompdf = new Dompdf($pdfOptions);
        $stylesheet = new Stylesheet($dompdf);
        $dompdf->getOptions()->setChroot('C:\xampp\htdocs\Archimed\public');
        $dompdf->setBasePath('C:\xampp\htdocs\Archimed\public');
        dump($dompdf->getBasePath(), $stylesheet, $request);
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
        $html = $this->renderView('test/IRMR/resultat_pdf.html.twig', [
            'graph'                 => $image64,
            'resultat'              => $resultat,
            'orderedPourcent'       => $orderedPourcent,
            'twoMineur'             => $twoMineur,
            'minor1'                => $minor1,
            'minor2'                => $minor2
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $this->json([
            "pdf" => base64_encode($dompdf->output())
        ]);
//        $dompdf->stream('mon-profil-Irmr.pdf', [
//            "Attachement"   => true
//        ]);
//        return $this->render('test/IRMR/resultat_pdf.html.twig', [
//            'graph'                 => $image64,
//            'resultat'              => $resultat,
//            'orderedPourcent'       => $orderedPourcent,
//            'twoMineur'             => $twoMineur,
//            'minor1'                => $minor1,
//            'minor2'                => $minor2
//        ]);

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