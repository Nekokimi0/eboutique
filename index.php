<?php
// ============================================================
// index.php — ...
// ============================================================

session_start();

require_once 'controllers/UtilisateurController.php';
require_once 'controllers/AdministrateurController.php';

$page = $_GET['page'] ?? 'accueil';

switch ($page) {

    case 'accueil':
        require 'views/accueil/index.php';
        break;
    
    case 'connexion':
        $controller = new UtilisateurController();
        $controller->connexion();
        break;

    case 'inscription':
        $controller = new UtilisateurController();
        $controller->inscription();
        break;

    case 'login':
        $controller = new AdministrateurController();
        $controller->connexion();
        break;

    case 'deconnexion':
        if (isset($_SESSION['administrateur_id'])) {
            $controller = new AdministrateurController();
            $controller->deconnexion();
        } elseif (isset($_SESSION['utilisateur_id'])) {
            $controller = new UtilisateurController();
            $controller->deconnexion();
        } else {
            header('Location: index.php?page=connexion');
            exit();
        }
        break;

    default:
        header('Location: index.php?page=accueil');
        exit();
}
?>