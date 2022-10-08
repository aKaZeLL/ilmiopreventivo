<?php

namespace App\Controller;

use App\Entity\MaterialiArredi;
use App\Form\MaterialiArrediType;
use App\Repository\MaterialiArrediRepository;
use App\Repository\PreventivoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/materiali_e_arredi')]
class MaterialiArrediController extends AbstractController
{
	/*
    #[Route('/', name: 'app_materiali_arredi_index', methods: ['GET'])]
    public function index(MaterialiArrediRepository $materialiArrediRepository): Response
    {
        return $this->render('materiali_arredi/index.html.twig', [
            'materiali_arredis' => $materialiArrediRepository->findAll(),
        ]);
    }
*/
    #[Route('/new', name: 'app_materiali_arredi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MaterialiArrediRepository $materialiArrediRepository, PreventivoRepository $preventivoRepository): Response
    {
		$preventivo = $preventivoRepository->find($request->query->get('id'));
		
        $materialiArredi = new MaterialiArredi();
		$materialiArredi->setPreventivo($preventivo);
        $form = $this->createForm(MaterialiArrediType::class, $materialiArredi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materialiArrediRepository->save($materialiArredi, true);

            return $this->redirectToRoute('app_preventivo', ['id'=>$preventivo->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiali_arredi/new.html.twig', [
            'materiali_arredi' => $materialiArredi,
            'form' => $form,
        ]);
    }
/*
    #[Route('/{id}', name: 'app_materiali_arredi_show', methods: ['GET'])]
    public function show(MaterialiArredi $materialiArredi): Response
    {
        return $this->render('materiali_arredi/show.html.twig', [
            'materiali_arredi' => $materialiArredi,
        ]);
    }
*/
    #[Route('/{id}/edit', name: 'app_materiali_arredi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MaterialiArredi $materialiArredi, MaterialiArrediRepository $materialiArrediRepository): Response
    {
        $form = $this->createForm(MaterialiArrediType::class, $materialiArredi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materialiArrediRepository->save($materialiArredi, true);

            return $this->redirectToRoute('app_preventivo', ['id'=>$materialiArredi->getPreventivo()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiali_arredi/edit.html.twig', [
            'materiali_arredi' => $materialiArredi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_materiali_arredi_delete', methods: ['POST'])]
    public function delete(Request $request, MaterialiArredi $materialiArredi, MaterialiArrediRepository $materialiArrediRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materialiArredi->getId(), $request->request->get('_token'))) {
            $materialiArrediRepository->remove($materialiArredi, true);
        }

        return $this->redirectToRoute('app_preventivo', ['id'=>$lavori->getPreventivo()->getId()], Response::HTTP_SEE_OTHER);
    }
}
