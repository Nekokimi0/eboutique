<?php
// ============================================================
// controllers/ProduitController.php
// Gère : catalogue et fiche produit côté client
// ============================================================

require_once 'models/Produit.php';
require_once 'models/CategorieProduit.php';

class ProduitController {

    private $modeleProduit;
    private $modeleCategorieProduit;

    public function __construct() {
        $this->modeleProduit = new Produit();
        $this->modeleCategorieProduit = new CategorieProduit();
    }

    // ── Pages client ─────────────────────────────────────────

    public function catalogue() {
        $categories = $this->modeleCategorieProduit->getAll();
        if (isset($_GET['id_categorie'])) {
            $produits = $this->modeleProduit->getByCategorie($_GET['id_categorie']);
        } else {
            $produits = $this->modeleProduit->getAll();
        }
        require 'views/client/catalogue.php';
    }

    public function fiche($id) {
        $produit = $this->modeleProduit->getById($id);
        require 'views/client/produit.php';
    }
}
?>
