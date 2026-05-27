<?php
// ============================================================
// models/Produit.php — ...
// ============================================================

require_once 'models/Model.php';

class Produit extends Model {

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
        $requete = $this->pdo->prepare("SELECT * FROM Produit WHERE id_categorie_produit = :id_categorie_produit ");
        $requete->execute([":id_categorie_produit" => $id_categorie]);
        return $requete->fetchAll();
    }

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Produit (nom, image, prix, quantite, description, id_categorie_produit) VALUES(:nom, :image, :prix, :quantite, :description, :id_categorie_produit)");
        return $requete->execute($data);
    }

    public function update($id, $data) {
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

    public function getStockFaible($seuil) {
        $requete = $this->pdo->prepare("SELECT * FROM Produit WHERE quantite < :quantite");
        $requete->execute([":quantite" => $seuil]);
        return $requete->fetchAll();
    }

}
?>
