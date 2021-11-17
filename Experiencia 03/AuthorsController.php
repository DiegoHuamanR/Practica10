<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Form\AuthorsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/authors')]
class AuthorsController extends AbstractController
{
    #[Route('/', name: 'authors_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $authors = $entityManager
            ->getRepository(Authors::class)
            ->findAll();

        return $this->render('authors/index.html.twig', [
            'authors' => $authors,
        ]);
    }

    #[Route('/new', name: 'authors_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $author = new Authors();
        $form = $this->createForm(AuthorsType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('authors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('authors/new.html.twig', [
            'author' => $author,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'authors_show', methods: ['GET'])]
    public function show(Authors $author): Response
    {
        return $this->render('authors/show.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/{id}/edit', name: 'authors_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Authors $author, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AuthorsType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('authors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('authors/edit.html.twig', [
            'author' => $author,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'authors_delete', methods: ['POST'])]
    public function delete(Request $request, Authors $author, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$author->getId(), $request->request->get('_token'))) {
            $entityManager->remove($author);
            $entityManager->flush();
        }

        return $this->redirectToRoute('authors_index', [], Response::HTTP_SEE_OTHER);
    }
}
