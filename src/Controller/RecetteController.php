<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'recette')]
    public function index(): Response
    {
        return $this->render('recette/recette.html.twig');
    }
    #[Route('/recette/detail', name: 'recette_detail')]
    public function detail(): Response
    {
        return $this->render('recette/recette_detail.html.twig');
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/recette/poster', name: 'recette_ajouter')]
    public function ajouter(): Response
    {
        return $this->render('recette/recette_ajouter.html.twig');
    }
}
