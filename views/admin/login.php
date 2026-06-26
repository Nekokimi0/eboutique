<?php
// ============================================================
// views/admin/login.php — Page de connexion administrateur
// ============================================================
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion Admin — Inkado</title>
        <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body class="page-auth">

        <div class="auth-container">
            <a href="index.php?page=accueil">
                <h1 class="logo">Inkado</h1>
            </a>

            <h2>Espace administrateur</h2>
            <p>Accès réservé</p>

            <?php if (isset($erreur)): ?>
                <p class="erreur"><?= $erreur ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?page=login">
                <div class="form-group">
                    <label>Login <span class="obligatoire">*</span></label>
                    <input type="text" name="login" placeholder="Votre login" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="obligatoire">*</span></label>
                    <input type="password" name="mot_de_passe" placeholder="Votre mot de passe" required>
                </div>
                <button type="submit">Se connecter →</button>
            </form>
            <p class="mention-obligatoire"><span class="obligatoire">*</span> Champs obligatoires</p>
        </div>

    </body>
</html>
