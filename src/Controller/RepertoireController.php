<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RepertoireController extends AbstractController
{
    #[Route('/repertoire', name: 'repertoire')]
    public function index(): Response
    {
        return $this->render('repertoire/repertoire.html.twig');
    }

    #[Route('/repertoire/detail', name: 'repertoire_detail')]
    public function detail(): Response
    {
        return $this->render('repertoire/repertoire_detail.html.twig');
    }
}
