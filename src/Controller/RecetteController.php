<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'recette')]
    public function index(): Response
    {
        return $this->render('recette/recette.html.twig');
    }
}
