<?php
// ============================================================
// views/client/panier.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="panier">
    <h1>Mon panier</h1>

    <p><?= array_sum(array_column($panier, 'quantite')) ?> article(s) dans votre panier</p>

    <?php if (empty($panier)): ?>
        <p>Votre panier est vide.</p>
        <a href="index.php?page=catalogue">← Retour au catalogue</a>
    <?php else: ?>

        <table class="panier-table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($panier as $article): ?>
                    <tr>
                        <td><?= $article['nom'] ?></td>
                        <td><?= $article['prix'] ?> €</td>
                        <td><?= $article['quantite'] ?></td>
                        <td><?= $article['prix'] * $article['quantite'] ?> €</td>
                        <td>
                            <a href="index.php?page=panier&action=supprimer&id_produit=<?= $article['id_produit'] ?>">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="panier-total">
            <p>Total : <strong><?= $prix_total ?> €</strong></p>
        </div>

        <div class="panier-actions">
            <a href="index.php?page=catalogue">← Continuer mes achats</a>
            <a href="index.php?page=panier&action=valider">Valider la commande →</a>
        </div>

    <?php endif; ?>
</section>

<?php
require 'views/templates/footer.php';
?>
