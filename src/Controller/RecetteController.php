<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RecetteController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/recette', name: 'recette')]
    public function index(): Response
    {
        $recette = $this->doctrine->getRepository(Recette::class)->findAll();

        $vars = [
            'recette' =>$recette
        ];

        return $this->render('recette/recette.html.twig', $vars);
    }
    #[Route('/recette/{nom}', name: 'recette_detail')]
    public function detail(string $nom): Response
    {    

        $recette = $this->doctrine->getRepository(Recette::class)->findOneBy(['nom' => $nom]);

        $vars = [
            'recette' => $recette
        ];

        // dd($vars);

        return $this->render('recette/recette_detail.html.twig', $vars);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/recette/poster', name: 'recette_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recette = new Recette();


        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        $user = $this->getUser();
        $recette->setUser($user);

        if ($form->isSubmitted() ) {
            // dd($form->getErrors());
            // Gestion de l'upload de l'avatar
            $file = $form->get('image')->getData();
            if ($file) {
                // Génère un nom unique pour l'avatar
                $newFileName = uniqid().'.'.$file->guessExtension();
        
                // Déplace le fichier dans le répertoire de destination
                try {
                    $file->move(
                        $this->getParameter('kernel.project_dir') . '/public/build/images/photosRecette', // ou le paramètre que tu as défini
                        $newFileName
                    );
                    // Met à jour l'utilisateur avec le nouveau nom de fichier
                    $recette->setImage($newFileName);
                } catch (FileException $e) {
                    // Gérer l'exception en cas d'échec de déplacement
                    $this->addFlash('error', 'L\'upload de l\'image a échoué.');
                    return $this->redirectToRoute('recette_ajouter');
                }
            }

            $entityManager->persist($recette);
            $entityManager->flush();

            return $this->redirectToRoute('recette');
        }


        return $this->render('recette/recette_ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
