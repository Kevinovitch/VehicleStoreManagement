<?php

namespace App\Controller;

use App\Service\VehiculeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VehiculeRepository;

#[Route('/api')]
class ApiController extends AbstractController
{

    private VehiculeService $vehiculeService;

    public function __construct(
        VehiculeService $vehiculeService
    )
    {
        $this->vehiculeService = $vehiculeService;
    }
    #[Route('/vehicules/search', name: 'app_api_vehicules_search', methods: ['GET'])]
    public function searchVehicules(
        Request $request
    ): JsonResponse {
        $search = $request->query->get('q');
        $proprietaireId = $request->query->get('proprietaire');
        $sortBy = $request->query->get('sort');
        $order = $request->query->get('order', 'ASC');

        $vehicules = $this->vehiculeService->searchVehicles($search, $proprietaireId, $sortBy, $order);

        return new JsonResponse($vehicules, Response::HTTP_OK);


    }
}