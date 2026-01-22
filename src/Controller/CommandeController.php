<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\PanierService;

#[Route('/commande')]
final class CommandeController extends AbstractController
{
    #[Route(name: 'app_commande_index', methods: ['GET'])]
    public function index(CommandeRepository $commandeRepository): Response
    {
        return $this->render('commande/index.html.twig', [
            'commandes' => $commandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, PanierService $panierService): Response
    {
        // Vérifier que le panier n'est pas vide
        $panierItems = $panierService->getFullPanier();
        if (empty($panierItems)) {
            $this->addFlash('warning', 'Votre panier est vide ! Ajoutez des produits avant de créer une commande.');
            return $this->redirectToRoute('app_catalogue');
        }

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Revérifier que le panier n'est pas vide avant de valider
            $panierItems = $panierService->getFullPanier();
            if (empty($panierItems)) {
                $this->addFlash('error', 'Votre panier est vide ! Impossible de créer une commande.');
                return $this->redirectToRoute('app_catalogue');
            }

            $commandeForm = $form->getData();
            $commandeForm->setDateCommande(new \DateTime());
            $commandeForm->setTotal((string)$panierService->getTotal());
            $commandeForm->setStatut('En attente de validation');
            $commandeForm->setUtilisateur($this->getUser());

            // Créer les lignes de commande à partir du panier
            foreach ($panierItems as $item) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->setProduit($item['produit']);
                $ligneCommande->setQuantite($item['quantite']);
                $ligneCommande->setPrixUnitaire($item['produit']->getPrix());
                $ligneCommande->setCommande($commandeForm);
                
                $commandeForm->addLignesCommande($ligneCommande);
                $entityManager->persist($ligneCommande);
            }

            $entityManager->persist($commandeForm);
            $entityManager->flush();
    
            // Vider le panier après validation
            $panierService->clear();
    
            $this->addFlash('success', 'Votre commande a été créée avec succès !');
            return $this->redirectToRoute('app_commande_show', ['id' => $commandeForm->getId()], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form,
            'panier' => $panierItems,
            'total' => $panierService->getTotal(),
        ]);
    }

    #[Route('/{id}', name: 'app_commande_show', methods: ['GET'])]
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commande_delete', methods: ['POST'])]
    public function delete(Request $request, Commande $commande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
    }
}
