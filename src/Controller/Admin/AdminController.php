<?php

namespace App\Controller\Admin;


use App\Service\ProprietaireService;
use App\Service\VehiculeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;;

#[Route('/admin')]
class AdminController extends AbstractController
{

    private ProprietaireService $proprietaireService;
    private VehiculeService $vehiculeService;

    public function __construct(
        ProprietaireService $proprietaireService,
        VehiculeService $vehiculeService
    )
    {
        $this->proprietaireService = $proprietaireService;
        $this->vehiculeService = $vehiculeService;
    }
    #[Route('/', name: 'app_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'proprietaires' => $this->proprietaireService->findAllProprietaires(),
            'vehicules' => $this->vehiculeService->findAllVehicules()
        ]);
    }

}