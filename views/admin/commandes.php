<?php
// ============================================================
// views/admin/commandes.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-commandes">
    <a href="index.php?page=dashboard">← Retour au dashboard</a>
    <h1>Gestion des commandes</h1>

    <?php if (empty($commandes)): ?>
        <p>Aucune commande pour le moment.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Livraison</th>
                    <th>Actions</th>
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
                        <td>
                            <!-- Changer le statut de la commande -->
                            <a href="index.php?page=admin_commandes&action=statut&id=<?= $commande['id_commande'] ?>&statut=Accepte">Accepter</a>
                            <a href="index.php?page=admin_commandes&action=statut&id=<?= $commande['id_commande'] ?>&statut=Refuse">Refuser</a>
                            <!-- Changer le statut de livraison -->
                            <a href="index.php?page=admin_commandes&action=livraison&id=<?= $commande['id_commande'] ?>&statut=Livre">Marquer livré</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php
require 'views/templates/footer.php';
?>
