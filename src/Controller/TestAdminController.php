<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Test;
use App\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("admin/tests/{id}", name="admin_test_")
 */
class TestAdminController extends AbstractController
{

    /**
     * @Route("/editer", name="editer")
     */
    public function editerTest(Test $test): Response
    {

        return $this->render('admin/editerTest.html.twig', [
            'test' => $test
        ]);
    }

    /**
     * @Route("/ajouterQuestion", name="add_question")
     */
    public function ajouterQuestion(Request $request, Test $test): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $question->setTest($test);
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('admin_test_editer', ['id' => $test->getId()]);
        }

        return $this->render('admin/addQuestion.html.twig', [
            'form' => $form->createView(),
            'test' => $test
        ]);
    }}
