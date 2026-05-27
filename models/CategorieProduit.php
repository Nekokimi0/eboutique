<?php
// ============================================================
// models/CategorieProduit.php — ...
// ============================================================

require_once 'models/Model.php';

class CategorieProduit extends Model {

    public function getAll() {
        $requete = $this->pdo->prepare("SELECT * FROM Categorie_Produit");
        $requete->execute();
        return $requete->fetchAll();
    }

    public function getById($id) {
        $requete = $this->pdo->prepare("SELECT * FROM Categorie_Produit WHERE id_categorie_produit = :id_categorie_produit");
        $requete->execute([":id_categorie_produit" => $id]);
        return $requete->fetch();
    }

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Categorie_Produit (nom) VALUES(:nom)");
        return $requete->execute($data);
    }

    public function update($id, $data) {
        $data[":id_categorie_produit"] = $id;
        $requete = $this->pdo->prepare("UPDATE Categorie_Produit SET nom = :nom WHERE id_categorie_produit = :id_categorie_produit");
        return $requete->execute($data);
    }

    public function delete($id) {
        $requete = $this->pdo->prepare("DELETE FROM Categorie_Produit WHERE id_categorie_produit = :id_categorie_produit");
        return $requete->execute([":id_categorie_produit" => $id]);
    }

}
?>
