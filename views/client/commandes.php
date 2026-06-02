<?php
// ============================================================
// views/client/commandes.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="commandes">
    <h1>Mes commandes</h1>

    <?php if (empty($commandes)): ?>
        <p>Vous n'avez pas encore de commandes.</p>
        <a href="index.php?page=catalogue">← Découvrir le catalogue</a>
    <?php else: ?>

        <table class="commandes-table">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Livraison</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td>#<?= $commande['id_commande'] ?></td>
                        <td><?= $commande['date'] ?></td>
                        <td><?= $commande['prix_total'] ?> €</td>
                        <td><?= $commande['statut'] ?></td>
                        <td><?= $commande['statut_livraison'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</section>

<?php
require 'views/templates/footer.php';
?>
