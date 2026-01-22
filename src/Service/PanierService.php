<?php

namespace App\Service;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    private RequestStack $requestStack;
    private EntityManagerInterface $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    private function getSession(): ?SessionInterface
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request && $request->hasSession()) {
            return $request->getSession();
        }
        return null;
    }

    public function add(int $id): void
    {
        $session = $this->getSession();
        if (!$session) {
            return;
        }

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);
    }

    public function remove(int $id): void
    {
        $session = $this->getSession();
        if (!$session) {
            return;
        }

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
    }

    public function decrease(int $id): void
    {
        $session = $this->getSession();
        if (!$session) {
            return;
        }

        $panier = $session->get('panier', []);
        if (isset($panier[$id])) {
            $panier[$id]--;
            if ($panier[$id] <= 0) {
                unset($panier[$id]);
            }
            $session->set('panier', $panier);
        }
    }

    public function updateQuantity(int $id, int $quantite): void
    {
        $session = $this->getSession();
        if (!$session) {
            return;
        }

        $panier = $session->get('panier', []);

        if ($quantite <= 0) {
            $this->remove($id);
        } else {
            $panier[$id] = $quantite;
            $session->set('panier', $panier);
        }
    }

    public function getFullPanier(): array
    {
        $session = $this->getSession();
        if (!$session) {
            return [];
        }

        $panier = $session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantite) {
            $produit = $this->em->getRepository(Produit::class)->find($id);
            if ($produit) {
                $panierWithData[] = [
                    'produit' => $produit,
                    'quantite' => $quantite
                ];
            }
        }

        return $panierWithData;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->getFullPanier() as $item) {
            $total += (float)$item['produit']->getPrix() * $item['quantite'];
        }

        return $total;
    }

    public function clear(): void
    {
        $session = $this->getSession();
        if (!$session) {
            return;
        }

        $session->remove('panier');
    }

    public function getCount(): int
    {
        $session = $this->getSession();
        if (!$session) {
            return 0;
        }

        $panier = $session->get('panier', []);
        return array_sum($panier);
    }
}
