<?php
// ============================================================
// views/admin/dashboard.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="dashboard">
    <h1>Tableau de bord</h1>

    <!-- Statistiques générales -->
    <div class="stats">
        <div class="stat-card">
            <h2><?= count($produits) ?></h2>
            <p>Produits</p>
        </div>
        <div class="stat-card">
            <h2><?= count($commandes) ?></h2>
            <p>Commandes</p>
        </div>
        <div class="stat-card">
            <h2><?= count($stock_faible) ?></h2>
            <p>Alertes stock</p>
        </div>
    </div>

    <!-- Alertes stock faible -->
    <?php if (!empty($stock_faible)): ?>
        <div class="alertes">
            <h2>⚠️ Stock faible</h2>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Stock restant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stock_faible as $produit): ?>
                        <tr>
                            <td><?= $produit['nom'] ?></td>
                            <td><?= $produit['quantite'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <!-- Raccourcis -->
    <div class="raccourcis">
        <a href="index.php?page=admin_produits">Gérer les produits</a>
        <a href="index.php?page=admin_categories">Gérer les catégories</a>
        <a href="index.php?page=admin_commandes">Gérer les commandes</a>
    </div>

</section>

<?php
require 'views/templates/footer.php';
?>
