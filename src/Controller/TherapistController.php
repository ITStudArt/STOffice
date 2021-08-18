<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TherapistController extends AbstractController
{
    #[Route('/therapist', name: 'therapist')]
    public function index(): Response
    {
        return $this->render('therapist/index.html.twig', [
            'controller_name' => 'TherapistController',
        ]);
    }
}
