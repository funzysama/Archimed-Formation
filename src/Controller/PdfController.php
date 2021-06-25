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
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request): Response
    {
        $fileName = $request->get('fileName');
        $fileManager = $this->newFileManager($request->query->all());
        $path = $fileManager->getQueryParameter('route');
        $basePath = $fileManager->getConfigurationParameter('dir');
        $basePath = str_replace('../public/', '/', $basePath);
        $chemin = str_replace('//','/', $basePath.urldecode($path)."/".$fileName);

        return $this->render('pdf/index.html.twig', [
            'chemin' => $chemin
        ]);
    }

}
