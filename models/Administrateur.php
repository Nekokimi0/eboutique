<?php
// ============================================================
// models/Administrateur.php — Modèle de gestion des administrateurs
// ============================================================

require_once 'models/Model.php';

class Administrateur extends Model {

    // ── Lecture ──────────────────────────────────────────────

    public function getByLogin($login) {
        $requete = $this->pdo->prepare("SELECT * FROM Administrateur WHERE login = :login");
        $requete->execute([":login" => $login]);
        return $requete->fetch();
    }
}
?>
