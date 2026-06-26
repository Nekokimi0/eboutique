<?php
// ============================================================
// controllers/CommandeController.php
// Gère : panier (session) et commandes client
// ============================================================

require_once 'models/Produit.php';
require_once 'models/Commande.php';
require_once 'models/LigneCommande.php';

class CommandeController {

    private $modeleProduit; // Modèle Produit
    private $modeleCommande; // Modèle Commande
    private $modeleLigneCommande; // Modèle LigneCommande

    public function __construct() {
        // Instanciation des modèles nécessaires
        $this->modeleProduit = new Produit();
        $this->modeleCommande = new Commande();
        $this->modeleLigneCommande = new LigneCommande();
    }

    // ── Panier ───────────────────────────────────────────────

    public function ajouterAuPanier() {
        $id_produit = $_POST['id_produit'];
        $quantite = $_POST['quantite'];

        // Vérification que le produit existe en BDD
        $produit = $this->modeleProduit->getById($id_produit);
        if (!$produit) {
            header('Location: index.php?page=catalogue');
            exit();
        }

        // Limitation de la quantité au stock disponible
        if ($quantite > $produit['quantite']) {
            $quantite = $produit['quantite'];
        }

        // Initialisation du panier en session si inexistant
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        // Si le produit est déjà dans le panier, on incrémente la quantité
        // Sinon, on l'ajoute comme nouvel article
        if (isset($_SESSION['panier'][$id_produit])) {
            $_SESSION['panier'][$id_produit]['quantite'] += $quantite;
        } else {
            $_SESSION['panier'][$id_produit] = [
                'id_produit' => $id_produit,
                'nom' => $produit['nom'],
                'prix' => $produit['prix'],
                'quantite' => $quantite
            ];
        }

        header('Location: index.php?page=catalogue');
        exit();
    }

    public function afficherPanier() {
        $panier = $_SESSION['panier'] ?? [];
        $prix_total = 0;

        // Calcul du prix total du panier
        foreach ($panier as $article) {
            $prix_total += $article['prix'] * $article['quantite'];
        }

        require 'views/client/panier.php';
    }

    public function supprimerDuPanier() {
        $id_produit = $_GET['id_produit'];

        // Suppression de l'article du panier en session
        if (isset($_SESSION['panier'])) {
            unset($_SESSION['panier'][$id_produit]);
        }

        header('Location: index.php?page=panier');
        exit();
    }

    // ── Commandes ────────────────────────────────────────────

    public function validerCommande() {
        // Vérification que l'utilisateur est connecté
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php?page=connexion');
            exit();
        }

        // Vérification que le panier n'est pas vide
        if (empty($_SESSION['panier'])) {
            header('Location: index.php?page=panier');
            exit();
        }

        // Calcul du prix total de la commande
        $prix_total = 0;
        foreach ($_SESSION['panier'] as $article) {
            $prix_total += $article['prix'] * $article['quantite'];
        }

        // Création de la commande en BDD
        $data = [
            ':date' => date('Y-m-d'),
            ':statut' => 'En attente',
            ':statut_livraison' => 'En attente',
            ':prix_total' => $prix_total,
            ':id_utilisateur' => $_SESSION['utilisateur_id']
        ];
        $this->modeleCommande->insert($data);

        // Récupération de l'id de la commande créée pour les lignes de commande
        $id_commande = $this->modeleCommande->lastInsertId();

        // Création des lignes de commande et mise à jour du stock pour chaque article
        foreach ($_SESSION['panier'] as $article) {
            $this->modeleLigneCommande->insert([
                ':quantite' => $article['quantite'],
                ':prix' => $article['prix'],
                ':id_commande' => $id_commande,
                ':id_produit' => $article['id_produit']
            ]);

            // Mise à jour du stock : stock actuel - quantité commandée
            $produit = $this->modeleProduit->getById($article['id_produit']);
            $nouveau_stock = $produit['quantite'] - $article['quantite'];
            $this->modeleProduit->updateStock($article['id_produit'], $nouveau_stock);
        }

        // Vidage du panier après validation
        unset($_SESSION['panier']);
        header('Location: index.php?page=commandes');
        exit();
    }

    public function mesCommandes() {
        // Vérification que l'utilisateur est connecté
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php?page=connexion');
            exit();
        }

        // Récupération des commandes de l'utilisateur connecté
        $commandes = $this->modeleCommande->getByUtilisateur($_SESSION['utilisateur_id']);

        // Récupération des lignes de commande pour chaque commande (accordéon)
        foreach ($commandes as &$commande) {
            $commande['lignes'] = $this->modeleLigneCommande->getByCommande($commande['id_commande']);
        }

        require 'views/client/commandes.php';
    }
}
?>
