<?php

namespace App\Controller;

use App\Entity\Preventivo;
use App\Form\PreventivoType;
use App\Repository\PreventivoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/preventivo')]
class PreventivoController extends AbstractController
{
    #[Route('/', name: 'app_preventivo_index', methods: ['GET'])]
    public function index(PreventivoRepository $preventivoRepository): Response
    {
        return $this->render('preventivo/index.html.twig', [
            'preventivos' => $preventivoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_preventivo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PreventivoRepository $preventivoRepository): Response
    {
        $preventivo = new Preventivo();
        $form = $this->createForm(PreventivoType::class, $preventivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preventivoRepository->save($preventivo, true);

            return $this->redirectToRoute('app_preventivo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('preventivo/new.html.twig', [
            'preventivo' => $preventivo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_preventivo_show', methods: ['GET'])]
    public function show(Preventivo $preventivo): Response
    {
        return $this->render('preventivo/show.html.twig', [
            'preventivo' => $preventivo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_preventivo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Preventivo $preventivo, PreventivoRepository $preventivoRepository): Response
    {
        $form = $this->createForm(PreventivoType::class, $preventivo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $preventivoRepository->save($preventivo, true);

            return $this->redirectToRoute('app_preventivo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('preventivo/edit.html.twig', [
            'preventivo' => $preventivo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_preventivo_delete', methods: ['POST'])]
    public function delete(Request $request, Preventivo $preventivo, PreventivoRepository $preventivoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preventivo->getId(), $request->request->get('_token'))) {
            $preventivoRepository->remove($preventivo, true);
        }

        return $this->redirectToRoute('app_preventivo_index', [], Response::HTTP_SEE_OTHER);
    }
}
