<?php
// ============================================================
// controllers/CommandeController.php - ...
// ============================================================

require_once 'models/Produit.php';
require_once 'models/Commande.php';
require_once 'models/LigneCommande.php';

class CommandeController {

    private $modeleProduit;
    private $modeleCommande;
     private $modeleLigneCommande;

    function __construct() {
        $this->modeleProduit = new Produit();
        $this->modeleCommande = new Commande();
        $this->modeleLigneCommande = new LigneCommande();
    }

    public function ajouterAuPanier() {
        $id_produit = $_POST['id_produit'];
        $quantite = $_POST['quantite'];
        $produit = $this->modeleProduit->getById($id_produit);
        if (!$produit) {
            header('Location: index.php?page=catalogue');
            exit();
        }
        if ($quantite > $produit['quantite']) {
            $quantite = $produit['quantite'];
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        if (isset($_SESSION['panier'][$id_produit])) {
            $_SESSION['panier'][$id_produit]['quantite'] += $quantite;
        } 
        else {
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
        foreach ($panier as $article) {
            $prix_total += $article['prix'] * $article['quantite'];
        }
        require 'views/client/panier.php';
    }

    public function supprimerDuPanier() {
        $id_produit = $_GET['id_produit'];
        if (isset($_SESSION['panier'])) {
            unset($_SESSION['panier'][$id_produit]);
        }
        header('Location: index.php?page=panier');
        exit();
    }

    public function validerCommande() {
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php?page=connexion');
            exit();
        }
        if (empty($_SESSION['panier'])) {
            header('Location: index.php?page=panier');
            exit();
        }
        $prix_total = 0;
        foreach ($_SESSION['panier'] as $article) {
            $prix_total += $article['prix'] * $article['quantite'];
        }
        $data = [':date' => date('Y-m-d'), ':statut' => 'En attente', ':statut_livraison' => 'En attente', ':prix_total' => $prix_total, ':id_utilisateur' => $_SESSION['utilisateur_id']];
        $this->modeleCommande->insert($data);
        $id_commande = $this->modeleCommande->lastInsertId();
        foreach ($_SESSION['panier'] as $article) {
            $this->modeleLigneCommande->insert([':quantite' => $article['quantite'], ':prix' => $article['prix'], ':id_commande' => $id_commande, ':id_produit' => $article['id_produit']]);
            $produit = $this->modeleProduit->getById($article['id_produit']);
            $nouveau_stock = $produit['quantite'] - $article['quantite'];
            $this->modeleProduit->updateStock($article['id_produit'], $nouveau_stock);
        }
        unset($_SESSION['panier']);
        header('Location: index.php?page=commandes');
        exit();
    }

    public function mesCommandes() {
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php?page=connexion');
            exit();
        }
        $commandes = $this->modeleCommande->getByUtilisateur($_SESSION['utilisateur_id']);
        foreach ($commandes as &$commande) {
            $commande['lignes'] = $this->modeleLigneCommande->getByCommande($commande['id_commande']);
        }
        require 'views/client/commandes.php';
    }

}
?>
