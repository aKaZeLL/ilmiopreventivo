<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Preventivo;

class PreventivoController extends AbstractController
{
    #[Route('/preventivo', name: 'app_make_preventivo')]
    public function make(): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('preventivo/make.html.twig', [
            
        ]);
    }

	#[Route('/preventivi', name: 'app_showAll')]
    public function showAll(): Response
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		$user = $this->getUser();

		$preventivi = $user->getPreventivi();

        return $this->render('preventivo/index.html.twig', [
            'preventivi' => $preventivi,
        ]);
    }
	
	#[Route('/preventivo/{id}', name: 'app_preventivo')]
    public function preventivo(Preventivo $prev): Response
    {
		dd($prev);

        return $this->render('preventivo/index.html.twig', [
            'preventivo' => $prev,
        ]);
    }
}
