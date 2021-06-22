<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Form\RessourceType;
use App\Repository\RessourceRepository;
use App\Service\UploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/ressource")
 */
class RessourceController extends AbstractController
{
    /**
     * @Route("/", name="ressource_index", methods={"GET"})
     * @param RessourceRepository $ressourceRepository
     * @return Response
     */
    public function index(RessourceRepository $ressourceRepository): Response
    {
        return $this->render('ressource/index.html.twig', [
            'ressources' => $ressourceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ressource_new", methods={"GET","POST"})
     * @param Request $request
     * @param UploadService $uploadService
     * @return Response
     */
    public function new(Request $request, UploadService $uploadService): Response
    {
        $ressource = new Ressource();

        $form = $this->createForm(RessourceType::class, $ressource);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if($image){

                $uploadDir = $this->getParameter('ressource_image_directory');
                $filename = $uploadService->upload($image, $uploadDir);
                $ressource->setImage($filename);

            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($ressource);
            $em->flush();

            return $this->redirectToRoute('ressource_index');

        }

        return $this->render('ressource/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ressource_show", methods={"GET"})
     * @param Ressource $ressource
     * @return Response
     */
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressource/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ressource_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Ressource $ressource
     * @param UploadService $uploadService
     * @return Response
     */
    public function edit(Request $request, Ressource $ressource, UploadService $uploadService): Response
    {
        $form = $this->createForm(RessourceType::class, $ressource);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();

            if($image){

                $uploadDir = $this->getParameter('ressource_image_directory');
                $filename = $uploadService->upload($image, $uploadDir);
                $ressource->setImage($filename);

            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ressource);
            $entityManager->flush();

            return $this->redirectToRoute('ressource_index');
        }

        return $this->render('ressource/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="ressource_delete", methods={"POST"})
     * @param Request $request
     * @param Ressource $ressource
     * @return Response
     */
    public function delete(Request $request, Ressource $ressource): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ressource_index');
    }

    /**
     * @Route("/delete/image/{id}", methods={"POST"})
     * @param Request $request
     * @param Ressource $ressource
     * @return Response
     */
    public function deleteImage(Request $request, Ressource $ressource): Response
    {
        $ressource->setImage('');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($ressource);
        $entityManager->flush();

        return $this->json('Ok');
    }
}
