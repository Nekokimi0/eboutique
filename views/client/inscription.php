<?php
// ============================================================
// views/client/inscription.php — ...
// ============================================================
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription — Inkado</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body class="page-auth">

        <div class="auth-container">
            <a href="index.php?page=accueil">
                <h1 class="logo">Inkado</h1>
            </a>

            <h2>Rejoignez Inkado</h2>

            <?php if (isset($erreur)): ?>
                <p class="erreur"><?= $erreur ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?page=inscription">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <input type="tel" name="telephone" placeholder="Téléphone">
                <input type="text" name="adresse" placeholder="Adresse">
                <input type="email" name="mail" placeholder="E-mail" required>
                <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
                <input type="password" name="mot_de_passe_confirm" placeholder="Confirmer le mot de passe" required>
                <button type="submit">Créer un compte →</button>
            </form>

            <a href="index.php?page=connexion">Déjà un compte ?</a>
        </div>

    </body>
</html>
