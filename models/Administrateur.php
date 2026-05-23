<?php
// ============================================================
// models/Administrateur.php — ...
// ============================================================

require_once 'models/Model.php';

class Administrateur extends Model {

    public function getByLogin($login) {
        $requete = $this->pdo->prepare("SELECT * FROM Administrateur WHERE login = :login");
        $requete->execute([":login" => $login]);
        return $requete->fetch();
    }
}
?>
