<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RegistrationFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $psHash): Response
    {
		$user = new User();
		
		$form = $this->createForm(RegistrationFormType::class, $user);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {

			$hashedPassword = $psHash->hashPassword($user, $user->Getpassword());
			$user->setPassword($hashedPassword);

			$em = $doctrine->getManager();
			$em->persist($user);
			$em->flush();
			
			return $this->redirect($this->generateUrl('app_home'));
		}
		
        return $this->renderForm('registration/index.html.twig', [
            'form' => $form,
        ]);
    }
}
