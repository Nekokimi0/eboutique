<?php
// ============================================================
// models/LigneCommande.php — Modèle de gestion des lignes de commande
// ============================================================

require_once 'models/Model.php';

class LigneCommande extends Model {

    // ── Lecture ──────────────────────────────────────────────

    public function getByCommande($id_commande) {
        // Récupère les lignes de commande avec le nom du produit via une jointure
        $requete = $this->pdo->prepare("
            SELECT Ligne_Commande.*, Produit.nom
            FROM Ligne_Commande
            JOIN Produit ON Ligne_Commande.id_produit = Produit.id_produit
            WHERE Ligne_Commande.id_commande = :id_commande
        ");
        $requete->execute([":id_commande" => $id_commande]);
        return $requete->fetchAll();
    }

    // ── Écriture ─────────────────────────────────────────────

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Ligne_Commande (quantite, prix, id_commande, id_produit) VALUES(:quantite, :prix, :id_commande, :id_produit)");
        return $requete->execute($data);
    }
}
?>
