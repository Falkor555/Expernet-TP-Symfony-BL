<?php

namespace App\Twig;

use App\Service\PanierService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class PanierExtension extends AbstractExtension
{
    private PanierService $panierService;

    public function __construct(PanierService $panierService)
    {
        $this->panierService = $panierService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('panier_count', [$this, 'getPanierCount']),
        ];
    }

    public function getPanierCount(): int
    {
        try {
            return $this->panierService->getCount();
        } catch (\Exception $e) {
            // En cas d'erreur (pas de session), retourner 0
            return 0;
        }
    }
}