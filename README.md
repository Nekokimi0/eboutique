# Inkado — E-boutique de mangas

Projet universitaire réalisé dans le cadre de la licence Informatique (L3) à l'Université Lyon 2.

Site web dynamique de vente de mangas, développé en PHP avec une architecture MVC.

---

## Aperçu

### Espace client

| Page d'accueil | Catalogue des produits avec filtres par catégorie |
|:-:|:-:|
| ![Accueil](screenshots/accueil.png) | ![Catalogue](screenshots/catalogue.png) |

| Fiche détail d'un produit | Panier du client |
|:-:|:-:|
| ![Produit](screenshots/produit.png) | ![Panier](screenshots/panier.png) |

| Historique des commandes avec accordéon ouvert |
|:-:|:-:|
| ![Historique](screenshots/historique.png) |

### Espace admin

| Tableau de bord administrateur | Gestion des produits |
|:-:|:-:|
| ![Tableau_bord](screenshots/tableau_bord.png) | ![Gestion_produits](screenshots/gestion_produits.png) |

| Formulaire d'ajout/modification de produit | Gestion des commandes avec badges et filtres |
|:-:|:-:|
| ![Formulaire_ajout_modification](screenshots/formulaire_ajout_modification.png) | ![Gestion_commandes](screenshots/gestion_commandes.png) |

---

## Technologies utilisées

- **PHP** — logique serveur et routing
- **MariaDB** — base de données relationnelle
- **PDO** — accès sécurisé à la base (requêtes préparées)
- **CSS** — mise en page et design (palette rose/pêche/or, police Pacifico)
- **Architecture MVC** — séparation claire des responsabilités

---

## Fonctionnalités

- Présentation des chats résidents avec fiches détaillées
- Menu du café (boissons, snacks) organisé par catégories
- Formulaire de réservation en ligne
- Espace d'administration sécurisé (authentification par session)
- Upload de photos pour les chats et les produits
- Gestion des horaires d'ouverture
- CRUD complet sur toutes les entités (admin)

---

## Structure de la base de données

La base contient 7 tables :

- `chats` — fiches des chats résidents
- `categories_menu` — catégories du menu
- `produits` — items du menu
- `reservations` — réservations des clients
- `horaires` — horaires d'ouverture
- `infos_site` — informations générales du café
- `admins` — comptes administrateurs

---

## Architecture du projet

```
Projet-php-bar-a-chat/
├── config/          # Configuration BDD et constantes
├── controllers/     # Contrôleurs (logique métier)
├── models/          # Modèles (accès aux données)
├── views/           # Templates HTML/PHP
├── public/          # Assets publics (CSS, images, JS)
├── index.php        # Point d'entrée unique (front controller)
└── init.sql         # Script d'initialisation de la base de données
```

---

## Installation locale

### Prérequis

- PHP 8.x
- MariaDB / MySQL
- Un serveur local type XAMPP, WAMP ou Laragon

### Étapes

1. Clone le repo
   ```bash
   git clone https://github.com/Aid4n4/Projet-php-bar-a-chat.git
   ```

2. Importe la base de données
   ```bash
   mysql -u root -p < init.sql
   ```

3. Configure la connexion dans `config/`  
   Renseigne tes identifiants BDD (hôte, nom de base, utilisateur, mot de passe)

4. Lance ton serveur local et ouvre le projet dans ton navigateur

---

## Auteurs

- **Serena Pot** — [@Aid4n4](https://github.com/Aid4n4)
- **Maély Thomas** - [@Nekokimi0](https://github.com/Nekokimi0)
- Université Lyon 2, 2026
