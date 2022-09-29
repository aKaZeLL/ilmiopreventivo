<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Preventivo;
use App\Entity\User;

class HomeController extends AbstractController
{
	#[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/preventivo/{user}', name: 'app_preventivo')]
    public function preventivo(User $user): Response
    {
		foreach ($user->getPreventivi() as $lavoro) {
			dd($lavoro);
		}
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
