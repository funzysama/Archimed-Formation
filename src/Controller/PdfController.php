<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PdfController extends AbstractController
{
    /**
     * @Route("/pdf/view", name="pdf_view")
     */
    public function index(Request $request): Response
    {
        $path = $request->get('path');
        $file = $request->get('file');
        $chemin = '/uploads'.$path.'/'.$file;
        return $this->render('pdf/index.html.twig', [
            'chemin' => $chemin
        ]);
    }
}
