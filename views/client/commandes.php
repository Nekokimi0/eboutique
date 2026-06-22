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
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $commande): ?>
                    <tr class="commande-row" onclick="toggleDetails(<?= $commande['id_commande'] ?>)">
                        <td>#<?= $commande['id_commande'] ?></td>
                        <td><?= $commande['date'] ?></td>
                        <td><?= $commande['prix_total'] ?> €</td>
                        <td><?= $commande['statut'] ?></td>
                        <td><?= $commande['statut_livraison'] ?></td>
                        <td class="toggle-icon">▼</td>
                    </tr>
                    <tr class="commande-details" id="details-<?= $commande['id_commande'] ?>">
                        <td colspan="6">
                            <table class="lignes-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        <th>Sous-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($commande['lignes'] as $ligne): ?>
                                        <tr>
                                            <td><?= $ligne['id_produit'] ?></td>
                                            <td><?= $ligne['prix'] ?> €</td>
                                            <td><?= $ligne['quantite'] ?></td>
                                            <td><?= $ligne['prix'] * $ligne['quantite'] ?> €</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
</section>

<script>
function toggleDetails(id) {
    const details = document.getElementById('details-' + id);
    const row = details.previousElementSibling;
    const icon = row.querySelector('.toggle-icon');
    
    if (details.classList.contains('open')) {
        details.classList.remove('open');
        icon.textContent = '▼';
    } else {
        details.classList.add('open');
        icon.textContent = '▲';
    }
}
</script>

<?php
require 'views/templates/footer.php';
?>
