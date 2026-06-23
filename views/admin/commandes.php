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
                            <?php if ($commande['statut'] === 'En attente'): ?>
                                <a href="index.php?page=admin_commandes&action=statut&id=<?= $commande['id_commande'] ?>&statut=Accepte"
                                   onclick="return confirm('Confirmer l\'acceptation de la commande #<?= $commande['id_commande'] ?> ?')">
                                    Accepter
                                </a>
                                <a href="index.php?page=admin_commandes&action=statut&id=<?= $commande['id_commande'] ?>&statut=Refuse"
                                   onclick="return confirm('Confirmer le refus de la commande #<?= $commande['id_commande'] ?> ?')"
                                   style="color: var(--c-danger);">
                                    Refuser
                                </a>
                            <?php elseif ($commande['statut'] === 'Accepte' && $commande['statut_livraison'] !== 'Livre'): ?>
                                <a href="index.php?page=admin_commandes&action=livraison&id=<?= $commande['id_commande'] ?>&statut=Livre"
                                   onclick="return confirm('Marquer la commande #<?= $commande['id_commande'] ?> comme livrée ?')">
                                    Marquer livré
                                </a>
                            <?php else: ?>
                                <span style="color: var(--c-subtle); font-size: .85rem;">Aucune action</span>
                            <?php endif; ?>
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
