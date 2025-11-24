# TP Symfony (2 semaines)
## Sujet : **Pâtisserie Ancelly – Plateforme de commande en ligne pour une pâtisserie**

Vous allez concevoir et développer, en Symfony, une application web permettant à une pâtisserie de proposer un **catalogue de produits** (gâteaux, entremets, macarons, etc.) et à ses clients de **passer des commandes** pour une **date donnée** (retrait ou livraison).

L’application sera utilisée par :
- des **clients** (qui consultent le catalogue et passent commande),
- des **gérants / pâtissiers** (qui gèrent le catalogue et les commandes).

---

## 1. Objectifs pédagogiques

- Concevoir des **maquettes** avant le développement.
- Identifier les **entités métier** pertinentes et leurs relations.
- Mettre en place un **modèle de données cohérent** utilisant Doctrine.
- Implémenter au minimum :
    - une relation **d’héritage**,
    - une relation **OneToOne**,
    - une relation **OneToMany**,
    - une relation **ManyToMany**.
- Développer les **pages CRUD** nécessaires (produits, catégories, commandes, etc.).

---

## 2. Contraintes obligatoires

### Maquettes
Les maquettes doivent être réalisées avant le début du développement et présentées à l’enseignant.  
Pages minimales :
- Accueil
- Catalogue des produits
- Détail d’un produit
- Espace utilisateur
- Inscription / Connexion
- Page de commande (panier + choix de date)

---

### Modélisation
Vous devez fournir dans un document ou dans le README :
- La **liste des entités** (User, Profile, Product, Category, Order, OrderItem…)
- La **description des relations** et cardinalités
- Un **diagramme UML / ERD** (facultatif mais recommandé)

---

### Relations imposées

#### ✔ Héritage
Exemples :  
`User` → `Customer` (client), `Manager` (pâtissier / gérant)

#### ✔ OneToOne
`User` ↔ `Profile`  
(informations complémentaires : adresse, téléphone, préférences…)

#### ✔ OneToMany
`Customer` → `Order` (un client peut passer plusieurs commandes)

#### ✔ ManyToMany
`Product` ↔ `Category`  
(un produit peut appartenir à plusieurs catégories)

---

## 3. Fonctionnalités minimales

### Gestion des utilisateurs
- Inscription
- Connexion / Déconnexion
- Rôles :
    - **Client** (ROLE_CUSTOMER)
    - **Gérant** (ROLE_MANAGER)
- Page de **profil utilisateur** (infos personnelles + commandes)

---

### Gestion du catalogue
- CRUD des **produits** :
    - nom, description, prix, tailles, image…
- (Optionnel mais recommandé) CRUD des **catégories**
- Consultation du catalogue
- Recherche / filtrage par catégorie

---

### Prise de commande
- Ajout de produits au **panier**
- Choix d’une **date de retrait / livraison**
- Validation d’une **commande**
- Une commande doit contenir :
    - le client
    - la date de commande
    - la date souhaitée
    - les produits + quantités
    - montant total

- Le client peut consulter :
    - son **historique de commandes**
    - le **détail** d’une commande

---

### Espace gérant
- Consultation des **commandes par date**
- Détail des commandes
- Gestion du catalogue (produits / catégories)

---

## 4. Exigences techniques

- Symfony
- Doctrine ORM
- Migrations
- Templates Twig
- Architecture propre (`Controllers`, `Entities`, `Forms`, `Templates`)

---

## 5. Livrables

1. **Maquettes** (captures ou lien Figma)
2. **Modélisation** :
    - Liste des entités
    - Relations
    - UML/ER (facultatif)
3. **Dépôt Git** contenant :
    - README d’installation
    - Configuration base de données
    - Migrations
4. **Démonstration orale** (10–15 minutes) présentant :
    - Le parcours client (catalogue → commande)
    - L’espace gérant (gestion catalogue + commandes)

---

## 6. Bonus possibles

- Gestion de **créneaux horaires** (ex : 9h–10h, 10h–11h)
- Système de **statut de commande** (en préparation / prête / livrée)
- Commentaires & notes sur les produits
- Upload d’image pour les produits
- Génération d’un **PDF** récapitulatif de commande
- Dashboard (chiffre d’affaires, commandes par jour, produits populaires)

---
