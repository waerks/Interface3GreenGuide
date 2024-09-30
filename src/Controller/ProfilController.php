<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/profil', name: 'profil')]
    public function index(): Response
    {
        return $this->render('profil/profil.html.twig');
    }
}
