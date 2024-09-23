<?php

namespace App\Controller;

use App\Entity\Element;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RepertoireController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/repertoire', name: 'repertoire')]
    public function index(): Response
    {
        $element = $this->doctrine->getRepository(Element::class)->findAll();

        $vars = [
            'element' => $element
        ];


        return $this->render('repertoire/repertoire.html.twig', $vars);
    }

    #[Route('/repertoire/{nom}', name: 'repertoire_detail')]
    public function detail(string $nom): Response
    {
        $element = $this->doctrine->getRepository(Element::class)->findOneBy(['nom' => $nom]);

        $vars = [
            'element' => $element
        ];

        return $this->render('repertoire/repertoire_detail.html.twig');
    }
}
