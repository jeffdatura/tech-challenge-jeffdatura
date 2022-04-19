<?php

namespace App\Controller;

use App\Entity\Proprio;
use App\Form\ProprioType;
use App\Repository\ProprioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/proprio')]
class ProprioController extends AbstractController
{
    #[Route('/', name: 'app_proprio_index', methods: ['GET'])]
    public function index(ProprioRepository $proprioRepository): Response
    {
        return $this->render('proprio/index.html.twig', [
            'proprios' => $proprioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_proprio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProprioRepository $proprioRepository): Response
    {
        $proprio = new Proprio();
        $form = $this->createForm(ProprioType::class, $proprio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proprioRepository->add($proprio);
            return $this->redirectToRoute('app_proprio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proprio/new.html.twig', [
            'proprio' => $proprio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_proprio_show', methods: ['GET'])]
    public function show(Proprio $proprio): Response
    {
        return $this->render('proprio/show.html.twig', [
            'proprio' => $proprio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_proprio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Proprio $proprio, ProprioRepository $proprioRepository): Response
    {
        $form = $this->createForm(ProprioType::class, $proprio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proprioRepository->add($proprio);
            return $this->redirectToRoute('app_proprio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proprio/edit.html.twig', [
            'proprio' => $proprio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_proprio_delete', methods: ['POST'])]
    public function delete(Request $request, Proprio $proprio, ProprioRepository $proprioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proprio->getId(), $request->request->get('_token'))) {
            $proprioRepository->remove($proprio);
        }

        return $this->redirectToRoute('app_proprio_index', [], Response::HTTP_SEE_OTHER);
    }
}
