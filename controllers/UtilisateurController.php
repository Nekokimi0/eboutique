<?php
// ============================================================
// controllers/UtilisateurController.php
// Gère : connexion, inscription et déconnexion client
// ============================================================

require_once 'models/Utilisateur.php';

class UtilisateurController {

    private $modele; // Modèle Utilisateur

    public function __construct() {
        // Instanciation du modèle Utilisateur
        $this->modele = new Utilisateur();
    }

    // ── Authentification ─────────────────────────────────────

    public function connexion() {
        $erreur = null;
        // Traitement du formulaire de connexion
        if (isset($_POST['mail'], $_POST['mot_de_passe'])) {
            $mail = $_POST['mail'];
            $mot_de_passe = $_POST['mot_de_passe'];
            // Récupération de l'utilisateur par son mail
            $utilisateur = $this->modele->getByMail($mail);
            // Vérification du mot de passe avec password_verify (bcrypt)
            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                // Création de la session utilisateur
                $_SESSION['utilisateur_id'] = $utilisateur['id_utilisateur'];
                $_SESSION['utilisateur_mail'] = $utilisateur['mail'];
                header('Location: index.php?page=catalogue');
                exit();
            } else {
                $erreur = "Identifiants incorrects.";
            }
        }
        require 'views/client/connexion.php';
    }

    public function inscription() {
        $erreur = null;
        // Traitement du formulaire d'inscription
        if (isset($_POST['mail'], $_POST['mot_de_passe'], $_POST['mot_de_passe_confirm'])) {
            // Vérification de la correspondance des mots de passe
            if ($_POST['mot_de_passe'] !== $_POST['mot_de_passe_confirm']) {
                $erreur = "Les mots de passe ne correspondent pas.";
            } else {
                // Vérification que le mail n'est pas déjà utilisé
                $existant = $this->modele->getByMail($_POST['mail']);
                if ($existant) {
                    $erreur = "Cette adresse mail est déjà utilisée.";
                } else {
                    // Hashage du mot de passe avant insertion en BDD
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
        // Destruction de la session et redirection vers l'accueil
        session_destroy();
        header('Location: index.php?page=accueil');
        exit();
    }

    // ── Utilitaire ───────────────────────────────────────────

    private function requireUtilisateur() {
        // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: index.php?page=connexion');
            exit();
        }
    }
}
?>
