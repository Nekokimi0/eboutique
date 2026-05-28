<?php
// ============================================================
// models/Commande.php — ...
// ============================================================

require_once 'models/Model.php';

class Commande extends Model {

    public function getAll() {
        $requete = $this->pdo->prepare("SELECT * FROM Commande");
        $requete->execute();
        return $requete->fetchAll();
    }

    public function getById($id) {
        $requete = $this->pdo->prepare("SELECT * FROM Commande WHERE id_commande = :id_commande");
        $requete->execute([":id_commande" => $id]);
        return $requete->fetch();
    }

    public function getByUtilisateur($id_utilisateur) {
        $requete = $this->pdo->prepare("SELECT * FROM Commande WHERE id_utilisateur = :id_utilisateur ");
        $requete->execute([":id_utilisateur" => $id_utilisateur]);
        return $requete->fetchAll();
    }

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Commande (date, statut, statut_livraison, prix_total, id_utilisateur) VALUES(:date, :statut, :statut_livraison, :prix_total, :id_utilisateur)");
        return $requete->execute($data);
    }

    public function updateStatut($id, $statut) {
        $requete = $this->pdo->prepare("UPDATE Commande SET statut = :statut WHERE id_commande = :id_commande");
        return $requete->execute([":id_commande" => $id, ":statut" => $statut]);
    }

    public function updateStatutLivraison($id, $statut_livraison) {
        $requete = $this->pdo->prepare("UPDATE Commande SET statut_livraison = :statut_livraison WHERE id_commande = :id_commande");
        return $requete->execute([":id_commande" => $id, ":statut_livraison" => $statut_livraison]);
    }

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

}
?>
