<?php
// ============================================================
// views/client/connexion.php — ...
// ============================================================
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion — Inkado</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body class="page-auth">

        <div class="auth-container">
            <a href="index.php?page=accueil">
                <h1 class="logo">Inkado</h1>
            </a>

            <h2>Se connecter</h2>
            <p>Connectez-vous ou créez un compte</p>

            <?php if (isset($erreur)): ?>
                <p class="erreur"><?= $erreur ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?page=connexion">
                <div class="form-group">
                    <label>E-mail <span class="obligatoire">*</span></label>
                    <input type="email" name="mail" placeholder="Votre e-mail" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="obligatoire">*</span></label>
                    <input type="password" name="mot_de_passe" placeholder="Votre mot de passe" required>
                </div>
                <button type="submit">Se connecter →</button>
            </form>
            <p class="mention-obligatoire"><span class="obligatoire">*</span> Champs obligatoires</p>

            <a href="index.php?page=inscription">Pas encore de compte ?</a>
        </div>

    </body>
</html>
