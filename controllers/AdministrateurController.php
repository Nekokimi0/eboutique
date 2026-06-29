<?php
// ============================================================
// controllers/AdministrateurController.php
// Gère : authentification admin, produits, catégories, commandes
// ============================================================

require_once 'models/Administrateur.php';
require_once 'models/Produit.php';
require_once 'models/CategorieProduit.php';
require_once 'models/Commande.php';

class AdministrateurController {

    private $modele; // Modèle Administrateur
    private $modeleProduit; // Modèle Produit
    private $modeleCategorieProduit; // Modèle CategorieProduit
    private $modeleCommande; // Modèle Commande

    public function __construct() {
        // Instanciation des modèles nécessaires
        $this->modele = new Administrateur();
        $this->modeleProduit = new Produit();
        $this->modeleCategorieProduit = new CategorieProduit();
        $this->modeleCommande = new Commande();
    }

    // ── Authentification ─────────────────────────────────────

    public function connexion() {
        $erreur = null;

        // Traitement du formulaire de connexion
        if (isset($_POST['login'], $_POST['mot_de_passe'])) {
            $login = $_POST['login'];
            $mot_de_passe = $_POST['mot_de_passe'];

            // Récupération de l'admin par son login
            $administrateur = $this->modele->getByLogin($login);

            // Vérification du mot de passe avec password_verify (bcrypt)
            if ($administrateur && password_verify($mot_de_passe, $administrateur['mot_de_passe'])) {
                // Création de la session admin
                $_SESSION['administrateur_id'] = $administrateur['id_administrateur'];
                $_SESSION['administrateur_login'] = $administrateur['login'];
                header('Location: index.php?page=dashboard');
                exit();
            } else {
                $erreur = "Identifiants incorrects.";
            }
        }

        require 'views/admin/login.php';
    }

    public function deconnexion() {
        // Destruction de la session et redirection vers l'accueil
        session_destroy();
        header('Location: index.php?page=accueil');
        exit();
    }

    // ── Dashboard ────────────────────────────────────────────

    public function dashboard() {
        $this->requireAdmin();

        // Récupération de toutes les données nécessaires au tableau de bord
        $produits = $this->modeleProduit->getAll();
        $commandes = $this->modeleCommande->getAll();
        $stock_faible = $this->modeleProduit->getStockFaible(5); // Seuil d'alerte : 5 unités
        $chiffre_affaires = $this->modeleCommande->getChiffreAffaires();
        $commandes_par_mois = $this->modeleCommande->getCommandesParMois();
        $plus_vendus = $this->modeleProduit->getPlusVendus();

        require 'views/admin/dashboard.php';
    }

    // ── Gestion des produits ─────────────────────────────────

    public function listeProduits() {
        $this->requireAdmin();
        $produits = $this->modeleProduit->getAll();
        $categories = $this->modeleCategorieProduit->getAll();
        require 'views/admin/produits.php';
    }

    public function ajouterProduit() {
        $this->requireAdmin();
        $categories = $this->modeleCategorieProduit->getAll();

        // Traitement du formulaire si soumis
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

        // Affichage du formulaire vide
        require 'views/admin/form_produit.php';
    }

    public function modifierProduit($id) {
        $this->requireAdmin();

        // Récupération du produit à modifier pour pré-remplir le formulaire
        $produit = $this->modeleProduit->getById($id);
        $categories = $this->modeleCategorieProduit->getAll();

        // Traitement du formulaire si soumis
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

        // Affichage du formulaire pré-rempli
        require 'views/admin/form_produit.php';
    }

    public function supprimerProduit($id) {
        $this->requireAdmin();
        $this->modeleProduit->delete($id);
        header('Location: index.php?page=admin_produits');
        exit();
    }

    public function ajouterStock($id) {
        $this->requireAdmin();

        // Calcul du nouveau stock : stock actuel + quantité ajoutée
        $quantite_ajout = $_POST['quantite_ajout'];
        $produit = $this->modeleProduit->getById($id);
        $nouveau_stock = $produit['quantite'] + $quantite_ajout;

        $this->modeleProduit->updateStock($id, $nouveau_stock);
        header('Location: index.php?page=dashboard');
        exit();
    }

    // ── Gestion des catégories ───────────────────────────────

    public function listeCategories() {
        $this->requireAdmin();
        $categories = $this->modeleCategorieProduit->getAll();
        require 'views/admin/categories.php';
    }

    public function ajouterCategorie() {
        $this->requireAdmin();

        // Traitement du formulaire si soumis
        if (isset($_POST['nom'])) {
            $data = [':nom' => $_POST['nom']];
            $this->modeleCategorieProduit->insert($data);
            header('Location: index.php?page=admin_categories');
            exit();
        }

        // Affichage du formulaire vide
        require 'views/admin/form_categorie.php';
    }

    public function modifierCategorie($id) {
        $this->requireAdmin();

        // Récupération de la catégorie pour pré-remplir le formulaire
        $categorie = $this->modeleCategorieProduit->getById($id);

        // Traitement du formulaire si soumis
        if (isset($_POST['nom'])) {
            $data = [':nom' => $_POST['nom']];
            $this->modeleCategorieProduit->update($id, $data);
            header('Location: index.php?page=admin_categories');
            exit();
        }

        // Affichage du formulaire pré-rempli
        require 'views/admin/form_categorie.php';
    }

    public function supprimerCategorie($id) {
        $this->requireAdmin();
        $this->modeleCategorieProduit->delete($id);
        header('Location: index.php?page=admin_categories');
        exit();
    }

    // ── Gestion des commandes ────────────────────────────────

    public function listeCommandes() {
        $this->requireAdmin();
        $commandes = $this->modeleCommande->getAll();
        require 'views/admin/commandes.php';
    }

    public function updateStatutCommande($id, $statut) {
        $this->requireAdmin();
        $this->modeleCommande->updateStatut($id, $statut);

        // Si la commande est refusée, la livraison est automatiquement mise à "Non livré"
        if ($statut === 'Refuse') {
            $this->modeleCommande->updateStatutLivraison($id, 'Non livre');
        }

        header('Location: index.php?page=admin_commandes');
        exit();
    }

    public function updateStatutLivraison($id, $statut_livraison) {
        $this->requireAdmin();
        $this->modeleCommande->updateStatutLivraison($id, $statut_livraison);
        header('Location: index.php?page=admin_commandes');
        exit();
    }

    // ── Utilitaire ───────────────────────────────────────────

    private function requireAdmin() {
        // Redirige vers la page de connexion si l'admin n'est pas connecté
        if (!isset($_SESSION['administrateur_id'])) {
            header('Location: index.php?page=login');
            exit();
        }
    }
}
?>
