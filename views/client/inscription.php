<?php
// ============================================================
// views/client/inscription.php — Page d'inscription client
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
                <div class="form-group">
                    <label>Nom <span class="obligatoire">*</span></label>
                    <input type="text" name="nom" placeholder="Votre nom" required>
                </div>
                <div class="form-group">
                    <label>Prénom <span class="obligatoire">*</span></label>
                    <input type="text" name="prenom" placeholder="Votre prénom" required>
                </div>
                <div class="form-group">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone" placeholder="Votre téléphone">
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse" placeholder="Votre adresse">
                </div>
                <div class="form-group">
                    <label>E-mail <span class="obligatoire">*</span></label>
                    <input type="email" name="mail" placeholder="Votre e-mail" required>
                </div>
                <div class="form-group">
                    <label>Mot de passe <span class="obligatoire">*</span></label>
                    <input type="password" name="mot_de_passe" placeholder="Votre mot de passe" required>
                </div>
                <div class="form-group">
                    <label>Confirmer le mot de passe <span class="obligatoire">*</span></label>
                    <input type="password" name="mot_de_passe_confirm" placeholder="Confirmez votre mot de passe" required>
                </div>
                <button type="submit">Créer un compte →</button>
            </form>
            <p class="mention-obligatoire"><span class="obligatoire">*</span> Champs obligatoires</p>

            <a href="index.php?page=connexion">Déjà un compte ?</a>
        </div>

    </body>
</html>
