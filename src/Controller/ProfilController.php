<?php

namespace App\Controller;

use App\Entity\Recette;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/profil', name: 'profil')]
    public function index(): Response
    {
        $user = $this->getUser();
        $recettes = $this->doctrine->getRepository(Recette::class)->findBy(['user' => $user]);

        $vars = [
            'recettes' => $recettes
        ];

        return $this->render('profil/profil.html.twig', $vars);
    }
}
