<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExercisesController extends AbstractController
{
    #[Route('/exercises', name: 'exercises')]
    public function index(): Response
    {
        return $this->render('exercises/index.html.twig', [
            'controller_name' => 'ExercisesController',
        ]);
    }
}
