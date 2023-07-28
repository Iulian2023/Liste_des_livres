<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Form\LivreFormType;
use App\Repository\LivresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    #[Route('/', name: 'app.index', methods:["GET"])]
    public function index(LivresRepository $livresRepository): Response
    {
        $livres = $livresRepository->findAll();

        return $this->render('pages/index.html.twig', [
            "livres" => $livres
        ]);
    }

    #[Route('/create', name: 'app.create', methods:["GET", "POST"])]
    public function create(Request $request, EntityManagerInterface $em): Response{
        $livre = new Livres;

        $form = $this->createForm(LivreFormType::class, $livre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($livre);
            $em->flush();

            $this->addFlash('success', 'La livre a été ajouté avec succées');
            return $this->redirectToRoute("app.index");
        }

        return $this->render("pages/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    #[Route('/edit/{id<\d+>}', name: 'app.edit', methods:["GET", "PUT"])]
    public function edit(Livres $livres, Request $request, EntityManagerInterface $em){
        $form = $this->createForm(LivreFormType::class, $livres, [
            "method" => "PUT"
        ]);

        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid()) {
            
            $em->persist($livres);
            $em->flush();

            $this->addFlash('success', 'La livre a été modifié avec succées');
            return $this->redirectToRoute("app.index");

        }

        return $this->render('pages/edit.html.twig', [
            "livres" => $livres,
            "form"    => $form
        ]);
    }

    #[Route('/delete/{id<\d+>}', name: 'app.delete', methods:["DELETE"])]
    public function delete(
        Livres $livres,
        Request $request,
        EntityManagerInterface $em
    ) : Response 
    {
        $token = $request->request->get('csrf_token');

        if ( $this->isCsrfTokenValid('delete_' . $livres->getId(), $token)) {
            
            $em->remove($livres);
            $em->flush();

            $this->addFlash('success', 'La livre a été supprimer avec succées');
        }

        return $this->redirectToRoute('app.index');
    }
}
