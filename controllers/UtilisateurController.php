<?php
// ============================================================
// controllers/UtilisateurController.php - ...
// ============================================================

require_once 'models/Utilisateur.php';

class UtilisateurController {

    private $modele;

    function __construct() {
        $this->modele = new Utilisateur();
    }

    public function connexion() {
        $erreur = null;
        if (isset($_POST['mail'], $_POST['mot_de_passe'])) {
            $mail = $_POST['mail'];
            $mot_de_passe = $_POST['mot_de_passe'];
            $utilisateur = $this->modele->getByMail($mail);
            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                $_SESSION['utilisateur_id'] = $utilisateur['id_utilisateur'];
                $_SESSION['utilisateur_mail'] = $utilisateur['mail'];
                header('Location: index.php?page=catalogue');
                exit();
            }
            else {
                $erreur = "Identifiants incorrects.";
            }
        }
        require 'views/client/connexion.php';
    }

    public function inscription() {
        $erreur = null;
        if (isset($_POST['mail'], $_POST['mot_de_passe'], $_POST['mot_de_passe_confirm'])) {
            if ($_POST['mot_de_passe'] !== $_POST['mot_de_passe_confirm']) {
                $erreur = "Les mots de passe ne correspondent pas.";
            } 
            else {
                $existant = $this->modele->getByMail($_POST['mail']);
                if ($existant) {
                    $erreur = "Cette adresse mail est déjà utilisée.";
                }
                else {
                    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
                    $data = [
                        ':nom' => $_POST['nom'],
                        ':prenom' => $_POST['prenom'],
                        ':mail' => $_POST['mail'],
                        ':telephone' => $_POST['telephone'] ?? null,
                        ':adresse' => $_POST['adresse'] ?? null,
                        ':mot_de_passe' => $mot_de_passe
                    ];
                    $this->modele->insert($data);
                    header('Location: index.php?page=connexion');
                    exit();
                }
            }
        }
        require 'views/client/inscription.php';
    }

    public function deconnexion() {
        session_destroy();
        header('Location: index.php?page=connexion');
        exit();
    }

    private function requireUtilisateur() {
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php?page=connexion');
            exit();
        }
    }
}
?>
