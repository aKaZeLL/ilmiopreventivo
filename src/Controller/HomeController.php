<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Preventivo;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;

class HomeController extends AbstractController
{
	#[Route('/', name: 'app_home')]
    public function home(Request $request, ManagerRegistry $doctrine): Response
    {
		//per negare accesso e redirect alla login
		//$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		//assegna utente se loggato
		$user = $this->getUser();

		$regForm = $this->createFormBuilder()
			->add('nome', TextType::class, [
				'label'=>'Nome Preventivo'])
			->add('Inizia', SubmitType::class)
			->getForm();
		$regForm->handleRequest($request);

		if ($regForm->isSubmitted() && $regForm->isValid() && $user) {
			$input = $regForm->getData();

			$prev = new Preventivo();
			$prev->setUser($user);
			$prev->setNome($input['nome']);
			$prev->setComplete(false);
			
			$em = $doctrine->getManager();
			$em->persist($prev);
			$em->flush();
			
			return $this->redirect($this->generateUrl('app_make_preventivo'));
		}

        return $this->render('home/index.html.twig', [
            'regForm' => $regForm->createView()
        ]);
    }
}
