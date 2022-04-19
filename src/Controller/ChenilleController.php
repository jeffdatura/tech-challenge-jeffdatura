<?php

namespace App\Controller;

use App\Entity\Chenille;
use App\Form\ChenilleType;
use App\Repository\ChenilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chenille')]
class ChenilleController extends AbstractController
{
    #[Route('/', name: 'app_chenille_index', methods: ['GET'])]
    public function index(ChenilleRepository $chenilleRepository): Response
    {
        return $this->render('chenille/index.html.twig', [
            'chenilles' => $chenilleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_chenille_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChenilleRepository $chenilleRepository): Response
    {
        $chenille = new Chenille();
        $form = $this->createForm(ChenilleType::class, $chenille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chenilleRepository->add($chenille);
            return $this->redirectToRoute('app_chenille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chenille/new.html.twig', [
            'chenille' => $chenille,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chenille_show', methods: ['GET'])]
    public function show(Chenille $chenille): Response
    {
        return $this->render('chenille/show.html.twig', [
            'chenille' => $chenille,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chenille_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chenille $chenille, ChenilleRepository $chenilleRepository): Response
    {
        $form = $this->createForm(ChenilleType::class, $chenille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chenilleRepository->add($chenille);
            return $this->redirectToRoute('app_chenille_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chenille/edit.html.twig', [
            'chenille' => $chenille,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chenille_delete', methods: ['POST'])]
    public function delete(Request $request, Chenille $chenille, ChenilleRepository $chenilleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chenille->getId(), $request->request->get('_token'))) {
            $chenilleRepository->remove($chenille);
        }

        return $this->redirectToRoute('app_chenille_index', [], Response::HTTP_SEE_OTHER);
    }
}
