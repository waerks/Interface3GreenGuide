<?php

namespace App\Controller;

use App\Entity\Recette;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    #[Route('/recette/detail', name: 'recette_detail')]
    public function detail(): Response
    {    
        return $this->render('recette/recette_detail.html.twig');
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/recette/poster', name: 'recette_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recette = new Recette();
        $user = $this->getUser();
        $recette->setUser($user);

        $form = $this->createFormBuilder($recette)
            ->add('nom')
            ->add('conseil')
            ->add('nombreDePersonnes')
            ->add('tempsDePreparation')
            ->add('tempsDeCuisson')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() /*&& $form->isValid()*/) {
            dd($form->getData());
            // Récupérer les ingrédients et les étapes du formulaire
            $ingredients = $request->request->get('ajoutIngre');
            $etapes = $request->request->get('etape');

            if ($ingredients) {
                $recette->setIngredients($ingredients);
            }

            if ($etapes) {
                $recette->setEtapes($etapes);
            }

            /** @var UploadedFile $file */

            $file = $request->files->get('file');

            if ($file) {
                $fileName = uniqid() . '.' . $file->guessExtension();

                $file->move(
                    $this->getParameter('kernel.project_dir') . '/public/build/images/photosRecette', // ou le paramètre que tu as défini
                    $fileName
                );
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
