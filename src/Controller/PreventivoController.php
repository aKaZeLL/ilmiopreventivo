<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Preventivo;

class PreventivoController extends AbstractController
{
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
    public function preventivo(Preventivo $preventivo): Response
    {
		$lavori = $preventivo->getLavori();
		$materiali = $preventivo->getMaterialiarredi();

        return $this->render('preventivo/detail.html.twig', [
			'materiali' => $materiali,
			'lavori' => $lavori,
            'preventivo' => $preventivo,
        ]);
    }
}
