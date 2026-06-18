<?php
// ============================================================
// views/templates/header.php — ...
// ============================================================
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inkado</title>
        <link rel="stylesheet" href="eboutique/public/css/style.css">
    </head>
    <body>
        <header>
            <nav>
                <a href="index.php?page=accueil">Inkado</a>
                <ul>
                    <li><a href="index.php?page=accueil">Accueil</a></li>
                    <li><a href="index.php?page=catalogue">Catalogue</a></li>
                    <li><a href="index.php?page=panier">Panier</a></li>
                    <?php if (isset($_SESSION['utilisateur_id'])): ?>
                        <li><a href="index.php?page=deconnexion">Se déconnecter</a></li>
                    <?php else: ?>
                        <li><a href="index.php?page=connexion">Se connecter</a></li>
                        <li><a href="index.php?page=inscription">S'inscrire</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main>
