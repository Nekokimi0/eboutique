<?php
// ============================================================
// controllers/AdministrateurController.php - ...
// ============================================================

require_once 'models/Administrateur.php';
require_once 'models/Produit.php';
require_once 'models/CategorieProduit.php';
require_once 'models/Commande.php';

class AdministrateurController {

    private $modele;
    private $modeleProduit;
    private $modeleCategorieProduit;
    private $modeleCommande;

    function __construct() {
        $this->modele = new Administrateur();
        $this->modeleProduit = new Produit();
        $this->modeleCategorieProduit = new CategorieProduit();
        $this->modeleCommande = new Commande();
    }

    public function connexion() {
        $erreur = null;
        if (isset($_POST['login'], $_POST['mot_de_passe'])) {
            $login = $_POST['login'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $administrateur = $this->modele->getByLogin($login);
            if ($administrateur && password_verify($mot_de_passe, $administrateur['mot_de_passe'])) {
                $_SESSION['administrateur_id'] = $administrateur['id_administrateur'];
                $_SESSION['administrateur_login'] = $administrateur['login'];
                header('Location: index.php?page=dashboard');
                exit();
            }
            else {
                $erreur = "Identifiants incorrects.";
            }
        }
        require 'views/admin/login.php';
    }

    public function deconnexion() {
        session_destroy();
        header('Location: index.php?page=login');
        exit();
    }

    public function dashboard() {
        $this->requireAdmin();
        $produits = $this->modeleProduit->getAll();
        $commandes = $this->modeleCommande->getAll();
        $stock_faible = $this->modeleProduit->getStockFaible(5);
        require 'views/admin/dashboard.php';
    }

    public function listeProduits() {
        $this->requireAdmin();
        $produits = $this->modeleProduit->getAll();
        $categories = $this->modeleCategorieProduit->getAll();
        require 'views/admin/produits.php';
    }

    public function ajouterProduit() {
        $this->requireAdmin();
        if (isset($_POST['nom'])) {
            $data = [
                ':nom' => $_POST['nom'],
                ':image' => $_POST['image'],
                ':prix' => $_POST['prix'],
                ':quantite' => $_POST['quantite'],
                ':description' => $_POST['description'],
                ':id_categorie_produit' => $_POST['id_categorie_produit']
            ];
            $this->modeleProduit->insert($data);
            header('Location: index.php?page=admin_produits');
            exit();
        }
        require 'views/admin/form_produit.php';
    }

    public function modifierProduit($id) {
        $this->requireAdmin();
        $produit = $this->modeleProduit->getById($id);
        if (isset($_POST['nom'])) {
            $data = [
                ':nom' => $_POST['nom'],
                ':image' => $_POST['image'],
                ':prix' => $_POST['prix'],
                ':quantite' => $_POST['quantite'],
                ':description' => $_POST['description'],
                ':id_categorie_produit' => $_POST['id_categorie_produit']
            ];
            $this->modeleProduit->update($id, $data);
            header('Location: index.php?page=admin_produits');
            exit();
        }
        require 'views/admin/form_produit.php';
    }

    public function supprimerProduit($id) {
        $this->requireAdmin();
        $this->modeleProduit->delete($id);
        header('Location: index.php?page=admin_produits');
        exit();
    }

    public function listeCategories() {
        $this->requireAdmin();
        $categories = $this->modeleCategorieProduit->getAll();
        require 'views/admin/categories.php';
    }

    public function ajouterCategorie() {
        $this->requireAdmin();
            if (isset($_POST['nom'])) {
            $data = [':nom' => $_POST['nom']];
            $this->modeleCategorieProduit->insert($data);
            header('Location: index.php?page=admin_categories');
            exit();
        }
        require 'views/admin/form_categorie.php';
    }

    public function modifierCategorie($id) {
        $this->requireAdmin();
        $categorie = $this->modeleCategorieProduit->getById($id);
        if (isset($_POST['nom'])) {
            $data = [':nom' => $_POST['nom']];
            $this->modeleCategorieProduit->update($id, $data);
            header('Location: index.php?page=admin_categories');
            exit();
        }
        require 'views/admin/form_categorie.php';
    }

    public function supprimerCategorie($id) {
        $this->requireAdmin();
        $this->modeleCategorieProduit->delete($id);
        header('Location: index.php?page=admin_categories');
        exit();
    }

    public function listeCommandes() {
        $this->requireAdmin();
        $commandes = $this->modeleCommande->getAll();
        require 'views/admin/commandes.php';
    }

    public function updateStatutCommande($id, $statut) {
        $this->requireAdmin();
        $this->modeleCommande->updateStatut($id, $statut);
        header('Location: index.php?page=admin_commandes');
        exit();
    }

    public function updateStatutLivraison($id, $statut_livraison) {
        $this->requireAdmin();
        $this->modeleCommande->updateStatutLivraison($id, $statut_livraison);
        header('Location: index.php?page=admin_commandes');
        exit();
    }

    private function requireAdmin() {
        if (!isset($_SESSION['administrateur_id'])) {
            header('Location: index.php?page=login');
            exit();
        }
    }
}
?>
