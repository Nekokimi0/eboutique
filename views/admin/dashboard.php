<?php
// ============================================================
// views/admin/dashboard.php — ...
// ============================================================

require 'views/templates/header.php';

// Préparer les données pour Chart.js
$labels_mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
$data_mois = array_fill(0, 12, 0);
foreach ($commandes_par_mois as $row) {
    $data_mois[$row['mois'] - 1] = $row['nombre'];
}

$labels_produits = array_column($plus_vendus, 'nom');
$data_produits = array_column($plus_vendus, 'total_vendu');
?>

<section class="dashboard">

    <div class="dashboard-header">
        <h1>Tableau de bord</h1>
        <a href="index.php?page=deconnexion">Se déconnecter</a>
    </div>

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
            <h2><?= number_format($chiffre_affaires['chiffre_affaires'] ?? 0, 2) ?> €</h2>
            <p>Chiffre d'affaires</p>
        </div>
        <div class="stat-card">
            <h2><?= count($stock_faible) ?></h2>
            <p>Alertes stock</p>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="graphiques">
        <div class="graphique-card">
            <h2>Commandes par mois</h2>
            <canvas id="graphiqueCommandes"></canvas>
        </div>
        <div class="graphique-card">
            <h2>Produits les plus vendus</h2>
            <canvas id="graphiqueProduits"></canvas>
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labelsMois = <?= json_encode($labels_mois) ?>;
    const dataMois = <?= json_encode($data_mois) ?>;
    const labelsProduits = <?= json_encode($labels_produits) ?>;
    const dataProduits = <?= json_encode($data_produits) ?>;

    new Chart(document.getElementById('graphiqueCommandes'), {
        type: 'line',
        data: {
            labels: labelsMois,
            datasets: [{
                label: 'Commandes',
                data: dataMois,
                borderColor: '#185FA5',
                backgroundColor: 'rgba(24, 95, 165, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById('graphiqueProduits'), {
        type: 'bar',
        data: {
            labels: labelsProduits,
            datasets: [{
                label: 'Quantité vendue',
                data: dataProduits,
                backgroundColor: 'rgba(24, 95, 165, 0.7)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>

<?php
require 'views/templates/footer.php';
?>
