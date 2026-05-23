<?php
// ============================================================
// controllers/AdministrateurController.php - ...
// ============================================================

require_once 'models/Administrateur.php';

class AdministrateurController {

    private $modele;

    function __construct() {
        $this->modele = new Administrateur();
    }

    public function connexion() {
        if (isset($_POST['login'], $_POST['mot_de_passe'])) {
            $login = $_POST['login'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $administrateur = $this->modele->getByLogin($login);
            if ($administrateur && password_verify($mot_de_passe, $administrateur['mot_de_passe'])) {
                $_SESSION['administrateur_id'] = $administrateur['id_administrateur'];
                $_SESSION['administrateur_login'] = $administrateur['login'];
                header('Location: index.php?page=dashboard');
                exit();
            }
            else {
                $erreur = "Identifiants incorrects.";
            }
        }
        require 'views/admin/login.php';
    }

    public function deconnexion() {
        session_destroy();
        header('Location: index.php?page=login');
        exit();
    }
}
?>
