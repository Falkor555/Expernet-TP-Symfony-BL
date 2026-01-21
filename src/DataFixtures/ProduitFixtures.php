<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            // Pièce montée
            ['cat' => 'Pièce montée', 'nom' => "Moule 9", 'prix' => '35.00'],
            ['cat' => 'Pièce montée', 'nom' => "Moule 10", 'prix' => '40.00'],
            ['cat' => 'Pièce montée', 'nom' => "3 étages", 'prix' => '65.00'],
            ['cat' => 'Pièce montée', 'nom' => "4 étages", 'prix' => '72.00'],
            ['cat' => 'Pièce montée', 'nom' => "5 étages", 'prix' => '95.00'],
            ['cat' => 'Pièce montée', 'nom' => "8 étages", 'prix' => '90.00'],
            ['cat' => 'Pièce montée', 'nom' => "9 étages", 'prix' => '120.00'],
            ['cat' => 'Pièce montée', 'nom' => "10 étages", 'prix' => '150.00'],
            ['cat' => 'Pièce montée', 'nom' => "10 étages + Plaque", 'prix' => '380.00'],
            ['cat' => 'Pièce montée', 'nom' => "10 étages + Carré", 'prix' => '290.00'],
            ['cat' => 'Pièce montée', 'nom' => "Carré 40cm", 'prix' => '150.00'],
            ['cat' => 'Pièce montée', 'nom' => "Plaque 40 * 60", 'prix' => '220.00'],
            ['cat' => 'Pièce montée', 'nom' => "Livre Carré", 'prix' => '70.00'],
            ['cat' => 'Pièce montée', 'nom' => "Livre Plaque", 'prix' => '150.00'],

            // Croque en Bouche
            ['cat' => 'Croque en Bouche', 'nom' => "60 choux", 'prix' => '100.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "90 choux", 'prix' => '150.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "130 choux", 'prix' => '200.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "Petit livre", 'prix' => '100.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "Moyen livre", 'prix' => '180.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "Plateau nougatine", 'prix' => '100.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "Nougatine personnalisée", 'prix' => '6.00'],
            ['cat' => 'Croque en Bouche', 'nom' => "Panier individuel", 'prix' => '3.80'],

            // Viennoiserie
            ['cat' => 'Viennoiserie', 'nom' => 'Pain au chocolat', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Pais aux raisins', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Croissant', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Brioche nature', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Brioche au chocolat', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Beignet', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Mascotte', 'prix' => '1.50'],
            ['cat' => 'Viennoiserie', 'nom' => 'Chausson aux Pommes', 'prix' => '1.00'],
            ['cat' => 'Viennoiserie', 'nom' => 'Torsade', 'prix' => '1.00'],

            // Four salé
            ['cat' => 'Four salé', 'nom' => 'Paté porc', 'prix' => '0.50'],
            ['cat' => 'Four salé', 'nom' => 'Paté poisson', 'prix' => '0.50'],
            ['cat' => 'Four salé', 'nom' => 'Paté poulet', 'prix' => '0.80'],
            ['cat' => 'Four salé', 'nom' => 'Quiche', 'prix' => '2.50'],
            ['cat' => 'Four salé', 'nom' => 'Pizza', 'prix' => '0.60'],
            ['cat' => 'Four salé', 'nom' => 'Mini quiche', 'prix' => '0.60'],
            ['cat' => 'Four salé', 'nom' => 'Croissant jambon', 'prix' => '0.60'],
            ['cat' => 'Four salé', 'nom' => 'Gougère', 'prix' => '0.60'],
            ['cat' => 'Four salé', 'nom' => 'Mini paté porc', 'prix' => '0.40'],
            ['cat' => 'Four salé', 'nom' => 'Mini paté poisson', 'prix' => '0.40'],
            ['cat' => 'Four salé', 'nom' => 'Mini paté poulet', 'prix' => '0.50'],
            ['cat' => 'Four salé', 'nom' => 'Allumette', 'prix' => '0.40'],
            ['cat' => 'Four salé', 'nom' => 'Mini burger', 'prix' => '1.50'],
            ['cat' => 'Four salé', 'nom' => 'Navette non garnie', 'prix' => '0.60'],
            ['cat' => 'Four salé', 'nom' => 'Navette garnie', 'prix' => '0.90'],

            // Four sucré
            ['cat' => 'Four sucré', 'nom' => 'Feuilleté', 'prix' => '0.50'],
            ['cat' => 'Four sucré', 'nom' => 'Chemin de fer', 'prix' => '1.00'],
            ['cat' => 'Four sucré', 'nom' => 'Masse Pain', 'prix' => '0.70'],
            ['cat' => 'Four sucré', 'nom' => 'Chou (praline, vanille, chocolat, caramel)', 'prix' => '0.60'],
            ['cat' => 'Four sucré', 'nom' => 'Éclair (café, chocolat, vanille)', 'prix' => '0.60'],
            ['cat' => 'Four sucré', 'nom' => 'Mille Feuille', 'prix' => '0.90'],
            ['cat' => 'Four sucré', 'nom' => 'Tarte (Citron, Fraise, Multi)', 'prix' => '0.90'],
            ['cat' => 'Four sucré', 'nom' => 'Mini Chemin de Fer', 'prix' => '0.90'],
            ['cat' => 'Four sucré', 'nom' => 'Coeur (Gingembre, Rose)', 'prix' => '1.20'],
            ['cat' => 'Four sucré', 'nom' => 'Tarte (Hérisson, Caramel, Marron Framboise, Cacao noir, Barquette Orange)', 'prix' => '1.10'],
        ];

        $categories = [];

        foreach ($data as $item) {
            // Gestion unique des catégories
            if (!isset($categories[$item['cat']])) {
                $category = new Category();
                $category->setNom($item['cat']);
                $manager->persist($category);
                $categories[$item['cat']] = $category;
            }

            $produit = new Produit();
            $produit->setNom($item['nom']);
            $produit->setPrix($item['prix']); // DECIMAL stocké en string dans l'entité
            $produit->setDateCreation(new \DateTime());
            $produit->setIsActive(true);
            $produit->setCategory($categories[$item['cat']]);
            
            // La description est nullable dans ton entité, on peut la laisser vide ou mettre le nom
            $produit->setDescription("Produit de la gamme " . $item['cat']);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}