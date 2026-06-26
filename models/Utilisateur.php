<?php
// ============================================================
// models/Utilisateur.php — Modèle de gestion des utilisateurs
// ============================================================

require_once 'models/Model.php';

class Utilisateur extends Model {

    // ── Lecture ──────────────────────────────────────────────

    public function getByMail($mail) {
        $requete = $this->pdo->prepare("SELECT * FROM Utilisateur WHERE mail = :mail");
        $requete->execute([":mail" => $mail]);
        return $requete->fetch();
    }

    // ── Écriture ─────────────────────────────────────────────

    public function insert($data) {
        $requete = $this->pdo->prepare("INSERT INTO Utilisateur (nom, prenom, mail, telephone, adresse, mot_de_passe) VALUES(:nom, :prenom, :mail, :telephone, :adresse, :mot_de_passe)");
        return $requete->execute($data);
    }
}
?>
