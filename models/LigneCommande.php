<?php
// ============================================================
// models/LigneCommande.php — ...
// ============================================================

require_once 'models/Model.php';

class LigneCommande extends Model {

    public function getByCommande($id_commande) {
        $requete = $this->pdo->prepare("SELECT Ligne_Commande.*, Produit.nom FROM Ligne_Commande JOIN Produit ON Ligne_Commande.id_produit = Produit.id_produit WHERE Ligne_Commande.id_commande = :id_commande");
        $requete->execute([":id_commande" => $id_commande]);
        return $requete->fetchAll();
    }

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Ligne_Commande (quantite, prix, id_commande, id_produit) VALUES(:quantite, :prix, :id_commande, :id_produit)");
        return $requete->execute($data);
    }

}
?>
