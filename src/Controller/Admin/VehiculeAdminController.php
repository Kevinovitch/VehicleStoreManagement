<?php

namespace App\Controller\Admin;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeAdminController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
    )
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/vehicule/new', name: 'app_vehicule_new', methods: ['GET', 'POST'])]
    public function newVehicule(Request $request): Response
    {
        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($vehicule);
            $this->entityManager->flush();

            $this->addFlash('success', 'Véhicule ajouté avec succès.');
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/vehicule/new.html.twig', [
            'form' => $form,
        ]);
    }

}