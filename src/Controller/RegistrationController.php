<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();
        
            // encode le mot de passe
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));
        
            // set le rôle par défaut
            $user->setRoles(['ROLE_USER']);
        
            // Gestion de l'upload de l'avatar
            $avatarFile = $form->get('avatar')->getData();
            if ($avatarFile) {
                // Génère un nom unique pour l'avatar
                $newFileName = uniqid().'.'.$avatarFile->guessExtension();
        
                // Déplace le fichier dans le répertoire de destination
                try {
                    $avatarFile->move(
                        $this->getParameter('kernel.project_dir') . '/public/build/images/avatars', // ou le paramètre que tu as défini
                        $newFileName
                    );
                    // Met à jour l'utilisateur avec le nouveau nom de fichier
                    $user->setAvatar($newFileName);
                } catch (FileException $e) {
                    // Gérer l'exception en cas d'échec de déplacement
                    $this->addFlash('error', 'L\'upload de l\'avatar a échoué.');
                    return $this->redirectToRoute('inscription');
                }
            }
        
            // Persiste l'utilisateur dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();
        
            return $this->redirectToRoute('accueil');
        }
        

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
