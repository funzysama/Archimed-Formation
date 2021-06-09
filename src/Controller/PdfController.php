<?php

namespace App\Controller;

use Artgris\Bundle\FileManagerBundle\Controller\ManagerController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends ManagerController
{
    /**
     * @Route("/pdf/view", name="pdf_view")
     */
    public function index(Request $request): Response
    {
        $fileName = $request->get('fileName');
        $fileManager = $this->newFileManager($request->query->all());
        $basePath = $fileManager->getConfigurationParameter('dir');
        $basePath = str_replace('../public/', '/', $basePath);
        $chemin = $basePath."/".$fileName;

        return $this->render('pdf/index.html.twig', [
            'chemin' => $chemin
        ]);
    }

}
