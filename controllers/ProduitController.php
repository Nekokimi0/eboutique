<?php
// ============================================================
// controllers/ProduitController.php - ...
// ============================================================

require_once 'models/Produit.php';
require_once 'models/CategorieProduit.php';

class ProduitController {

    private $modeleProduit;
    private $modeleCategorieProduit;

    function __construct() {
        $this->modeleProduit = new Produit();
        $this->modeleCategorieProduit = new CategorieProduit();
    }

    public function catalogue() {
        $produits = $this->modeleProduit->getAll();
        $categories = $this->modeleCategorieProduit->getAll();
        require 'views/client/catalogue.php'; 
    }

    public function fiche($id) {
        $produit = $this->modeleProduit->getById($id);
        require 'views/client/produit.php';
    }

}
?>
