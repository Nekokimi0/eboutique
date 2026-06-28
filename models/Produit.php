<?php
// ============================================================
// models/Produit.php — Modèle de gestion des produits
// ============================================================

require_once 'models/Model.php';

class Produit extends Model {

    // ── Lecture ──────────────────────────────────────────────

    public function getAll() {
        $requete = $this->pdo->prepare("SELECT * FROM Produit");
        $requete->execute();
        return $requete->fetchAll();
    }

    public function getById($id) {
        $requete = $this->pdo->prepare("SELECT * FROM Produit WHERE id_produit = :id_produit");
        $requete->execute([":id_produit" => $id]);
        return $requete->fetch();
    }

    public function getByCategorie($id_categorie) {
        $requete = $this->pdo->prepare("SELECT * FROM Produit WHERE id_categorie_produit = :id_categorie_produit");
        $requete->execute([":id_categorie_produit" => $id_categorie]);
        return $requete->fetchAll();
    }

    public function getStockFaible($seuil) {
        // Retourne les produits dont la quantité est inférieure au seuil donné
        $requete = $this->pdo->prepare("SELECT * FROM Produit WHERE quantite < :quantite");
        $requete->execute([":quantite" => $seuil]);
        return $requete->fetchAll();
    }

    public function getPlusVendus() {
        // Retourne les 5 produits les plus vendus via une jointure avec Ligne_Commande
        $requete = $this->pdo->prepare("
            SELECT Produit.nom, SUM(Ligne_Commande.quantite) AS total_vendu
            FROM Produit
            JOIN Ligne_Commande ON Produit.id_produit = Ligne_Commande.id_produit
            GROUP BY Produit.id_produit
            ORDER BY total_vendu DESC
            LIMIT 5
        ");
        $requete->execute();
        return $requete->fetchAll();
    }

    // ── Écriture ─────────────────────────────────────────────

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Produit (nom, image, prix, quantite, description, id_categorie_produit) VALUES(:nom, :image, :prix, :quantite, :description, :id_categorie_produit)");
        return $requete->execute($data);
    }

    public function update($id, $data) {
        // Ajout de l'id du produit dans le tableau de données pour la clause WHERE
        $data[":id_produit"] = $id;
        $requete = $this->pdo->prepare("UPDATE Produit SET nom = :nom, image = :image, prix = :prix, quantite = :quantite, description = :description, id_categorie_produit = :id_categorie_produit WHERE id_produit = :id_produit");
        return $requete->execute($data);
    }

    public function delete($id) {
        $requete = $this->pdo->prepare("DELETE FROM Produit WHERE id_produit = :id_produit");
        return $requete->execute([":id_produit" => $id]);
    }

    public function updateStock($id, $quantite) {
        $requete = $this->pdo->prepare("UPDATE Produit SET quantite = :quantite WHERE id_produit = :id_produit");
        return $requete->execute([":id_produit" => $id, ":quantite" => $quantite]);
    }
}
?>
