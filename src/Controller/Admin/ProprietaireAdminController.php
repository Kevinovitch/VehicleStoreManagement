<?php

namespace App\Controller\Admin;

use App\Entity\Proprietaire;
use App\Entity\Vehicule;
use App\Form\ProprietaireType;
use App\Form\VehiculeType;
use App\Service\ProprietaireService;
use App\Service\VehiculeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;;

class ProprietaireAdminController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
    )
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/proprietaire/new', name: 'app_proprietaire_new', methods: ['GET', 'POST'])]
    public function newProprietaire(Request $request): Response
    {
        $proprietaire = new Proprietaire();
        $form = $this->createForm(ProprietaireType::class, $proprietaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($proprietaire);
            $this->entityManager->flush();

            $this->addFlash('success', 'Propriétaire ajouté avec succès.');
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('admin/proprietaire/new.html.twig', [
            'form' => $form,
        ]);
    }
}