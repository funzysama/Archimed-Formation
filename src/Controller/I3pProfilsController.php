<?php

namespace App\Controller;

use App\Entity\I3pProfils;
use App\Form\I3pProfilsType;
use App\Repository\I3pProfilsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/i3p/profils")
 */
class I3pProfilsController extends AbstractController
{
    /**
     * @Route("/", name="i3p_profils_index", methods={"GET"})
     */
    public function index(I3pProfilsRepository $i3pProfilsRepository): Response
    {
        return $this->render('i3p_profils/index.html.twig', [
            'i3p_profils' => $i3pProfilsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="i3p_profils_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $i3pProfil = new I3pProfils();
        $form = $this->createForm(I3pProfilsType::class, $i3pProfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($i3pProfil);
            $entityManager->flush();

            return $this->redirectToRoute('i3p_profils_index');
        }

        return $this->render('i3p_profils/new.html.twig', [
            'i3p_profil' => $i3pProfil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="i3p_profils_show", methods={"GET"})
     */
    public function show(I3pProfils $i3pProfil): Response
    {
        return $this->render('i3p_profils/show.html.twig', [
            'i3p_profil' => $i3pProfil,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="i3p_profils_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, I3pProfils $i3pProfil): Response
    {
        $form = $this->createForm(I3pProfilsType::class, $i3pProfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('i3p_profils_index');
        }

        return $this->render('i3p_profils/edit.html.twig', [
            'i3p_profil' => $i3pProfil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="i3p_profils_delete", methods={"POST"})
     */
    public function delete(Request $request, I3pProfils $i3pProfil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$i3pProfil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($i3pProfil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('i3p_profils_index');
    }
}
