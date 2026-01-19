<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin_dashboard')]
    public function dashboard(
        ProduitRepository $produitRepository,
        CommandeRepository $commandeRepository,
        UtilisateurRepository $utilisateurRepository
    ): Response {
        // Statistiques pour le tableau de bord admin
        $stats = [
            'total_produits' => $produitRepository->count([]),
            'produits_actifs' => $produitRepository->count(['isActive' => true]),
            'total_commandes' => $commandeRepository->count([]),
            'total_utilisateurs' => $utilisateurRepository->count([]),
        ];

        return $this->render('admin/dashboard.html.twig', [
            'stats' => $stats,
        ]);
    }
}