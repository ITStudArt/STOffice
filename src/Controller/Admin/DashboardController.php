<?php

namespace App\Controller\Admin;

use App\Entity\Exercises;
use App\Entity\ExercisesType;
use App\Entity\Patient;
use App\Entity\Therapist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ExercisesTypeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<span style="font-size: 32px">STOffice</span>');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Exercises', 'fa fa-tags', Exercises::class);
        yield MenuItem::linkToCrud('Exercises Types', 'fa fa-file-text', ExercisesType::class);
        yield MenuItem::linkToCrud('Patients', 'fas fa-list', Patient::class);
        yield MenuItem::linkToCrud('Therapists', 'fas fa-list', Therapist::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-user', \App\Entity\User::class);
    }
}
