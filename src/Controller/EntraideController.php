<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntraideController extends AbstractController
{
    #[Route('/entraide', name: 'entraide')]
    public function index(): Response
    {
        return $this->render('entraide/entraide.html.twig');
    }
    #[Route('/entraide/detail', name: 'entraide_detail')]
    public function detail(): Response
    {
        return $this->render('entraide/entraide_detail.html.twig');
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/entraide/ajouter', name: 'entraide_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('entraide/entraide_ajouter.html.twig');
    }
}
