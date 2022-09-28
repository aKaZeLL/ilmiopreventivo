<?php

namespace App\Controller;

use App\Entity\Lavori;
use App\Form\LavoriType;
use App\Repository\LavoriRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lavori')]
class LavoriController extends AbstractController
{
    #[Route('/', name: 'app_lavori_index', methods: ['GET'])]
    public function index(LavoriRepository $lavoriRepository): Response
    {
        return $this->render('lavori/index.html.twig', [
            'lavoris' => $lavoriRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lavori_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LavoriRepository $lavoriRepository): Response
    {
        $lavori = new Lavori();
        $form = $this->createForm(LavoriType::class, $lavori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lavoriRepository->save($lavori, true);

            return $this->redirectToRoute('app_lavori_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lavori/new.html.twig', [
            'lavori' => $lavori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lavori_show', methods: ['GET'])]
    public function show(Lavori $lavori): Response
    {
        return $this->render('lavori/show.html.twig', [
            'lavori' => $lavori,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lavori_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lavori $lavori, LavoriRepository $lavoriRepository): Response
    {
        $form = $this->createForm(LavoriType::class, $lavori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lavoriRepository->save($lavori, true);

            return $this->redirectToRoute('app_lavori_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lavori/edit.html.twig', [
            'lavori' => $lavori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lavori_delete', methods: ['POST'])]
    public function delete(Request $request, Lavori $lavori, LavoriRepository $lavoriRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lavori->getId(), $request->request->get('_token'))) {
            $lavoriRepository->remove($lavori, true);
        }

        return $this->redirectToRoute('app_lavori_index', [], Response::HTTP_SEE_OTHER);
    }
}
