<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

final class PostsController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function index(): Response
    {
        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
        ]);
    }

    #[Route('/post/new', name: 'app_post_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Posts();
        $form = $this->createForm(PostsType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer l'upload du fichier si nécessaire
            $file = $form->get('content_multimedia')->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $file->move($this->getParameter('uploads_directory'), $fileName);
                $post->setContentMultimedia($fileName);
            }

            // Enregistrer le post dans la base de données
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_posts_success');
        }

        return $this->render('posts/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/posts/success', name: 'app_posts_success')]
    public function success(): Response
    {
        return new Response('Post créé avec succès !');
    }
}
