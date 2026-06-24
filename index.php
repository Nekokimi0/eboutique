<?php
// ============================================================
// index.php — ...
// ============================================================

session_start();

require_once 'controllers/UtilisateurController.php';
require_once 'controllers/AdministrateurController.php';
require_once 'controllers/ProduitController.php';
require_once 'controllers/CommandeController.php';

$page = $_GET['page'] ?? 'accueil';

switch ($page) {

    case 'accueil':
        require 'views/accueil/index.php';
        break;

    case 'catalogue':
        $controller = new ProduitController();
        $controller->catalogue();
        break;

    case 'produit':
        $controller = new ProduitController();
        $controller->fiche($_GET['id'] ?? null);
        break;
    
    case 'connexion':
        $controller = new UtilisateurController();
        $controller->connexion();
        break;

    case 'panier':
        $controller = new CommandeController();
        $action = $_GET['action'] ?? 'afficher';
        if ($action === 'ajouter') {
            $controller->ajouterAuPanier();
        } elseif ($action === 'supprimer') {
            $controller->supprimerDuPanier();
        } elseif ($action === 'valider') {
            $controller->validerCommande();
        } else {
            $controller->afficherPanier();
        }
        break;

    case 'commandes':
        $controller = new CommandeController();
        $controller->mesCommandes();
        break;

    case 'dashboard':
        $controller = new AdministrateurController();
        $controller->dashboard();
        break;

    case 'admin_produits':
        $controller = new AdministrateurController();
        $action = $_GET['action'] ?? 'liste';
        if ($action === 'ajouter') {
            $controller->ajouterProduit();
        } elseif ($action === 'modifier') {
            $controller->modifierProduit($_GET['id'] ?? null);
        } elseif ($action === 'supprimer') {
            $controller->supprimerProduit($_GET['id'] ?? null);
        } 
        elseif ($action === 'stock') {
            $controller->ajouterStock($_GET['id'] ?? null);
        } else {
            $controller->listeProduits();
        }
        break;

    case 'admin_categories':
        $controller = new AdministrateurController();
        $action = $_GET['action'] ?? 'liste';
        if ($action === 'ajouter') {
            $controller->ajouterCategorie();
        } elseif ($action === 'modifier') {
            $controller->modifierCategorie($_GET['id'] ?? null);
        } elseif ($action === 'supprimer') {
            $controller->supprimerCategorie($_GET['id'] ?? null);
        } else {
            $controller->listeCategories();
        }
        break;

    case 'admin_commandes':
        $controller = new AdministrateurController();
        $action = $_GET['action'] ?? 'liste';
        if ($action === 'statut') {
            $controller->updateStatutCommande($_GET['id'] ?? null, $_GET['statut'] ?? null);
        } elseif ($action === 'livraison') {
            $controller->updateStatutLivraison($_GET['id'] ?? null, $_GET['statut'] ?? null);
        } else {
            $controller->listeCommandes();
        }
        break;

    case 'inscription':
        $controller = new UtilisateurController();
        $controller->inscription();
        break;

    case 'login':
        $controller = new AdministrateurController();
        $controller->connexion();
        break;

    case 'deconnexion':
        if (isset($_SESSION['administrateur_id'])) {
            $controller = new AdministrateurController();
            $controller->deconnexion();
        } elseif (isset($_SESSION['utilisateur_id'])) {
            $controller = new UtilisateurController();
            $controller->deconnexion();
        } else {
            header('Location: index.php?page=connexion');
            exit();
        }
        break;

    default:
        header('Location: index.php?page=accueil');
        exit();
}
?>
