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

        <div class="commandes-filtres">
            <select id="filtreStatut" onchange="filtrerCommandes()">
                <option value="">Tous les statuts</option>
                <option value="En attente">En attente</option>
                <option value="Accepté">Accepté</option>
                <option value="Refusé">Refusé</option>
            </select>
            <select id="filtreLivraison" onchange="filtrerCommandes()">
                <option value="">Toutes les livraisons</option>
                <option value="En attente">En attente</option>
                <option value="Livré">Livré</option>
                <option value="Non livré">Non livré</option>
            </select>
        </div>

        <table id="tableCommandes">
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
                    <tr data-statut="<?= $commande['statut'] ?>" data-livraison="<?= $commande['statut_livraison'] ?>">
                        <td>#<?= $commande['id_commande'] ?></td>
                        <td><?= $commande['date'] ?></td>
                        <td><?= $commande['prix_total'] ?> €</td>
                        <td>
                            <?php if ($commande['statut'] === 'Accepté'): ?>
                                <span class="badge badge-success"><?= $commande['statut'] ?></span>
                            <?php elseif ($commande['statut'] === 'Refusé'): ?>
                                <span class="badge badge-danger"><?= $commande['statut'] ?></span>
                            <?php else: ?>
                                <span class="badge badge-warning"><?= $commande['statut'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($commande['statut'] === 'Refusé'): ?>
                                <span class="badge badge-danger">Non livré</span>
                            <?php elseif ($commande['statut_livraison'] === 'Livré'): ?>
                                <span class="badge badge-success"><?= $commande['statut_livraison'] ?></span>
                            <?php elseif ($commande['statut_livraison'] === 'Non livré'): ?>
                                <span class="badge badge-danger"><?= $commande['statut_livraison'] ?></span>
                            <?php else: ?>
                                <span class="badge badge-warning"><?= $commande['statut_livraison'] ?></span>
                            <?php endif; ?>
                        </td>
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
                            <?php elseif ($commande['statut'] === 'Accepté' && $commande['statut_livraison'] !== 'Livré'): ?>
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

<script>
function filtrerCommandes() {
    const filtreStatut = document.getElementById('filtreStatut').value;
    const filtreLivraison = document.getElementById('filtreLivraison').value;
    const lignes = document.querySelectorAll('#tableCommandes tbody tr');

    lignes.forEach(ligne => {
        const statut = ligne.dataset.statut;
        const livraison = ligne.dataset.livraison;

        const matchStatut = filtreStatut === '' || statut === filtreStatut;
        const matchLivraison = filtreLivraison === '' || livraison === filtreLivraison;

        ligne.style.display = (matchStatut && matchLivraison) ? '' : 'none';
    });
}
</script>

<?php
require 'views/templates/footer.php';
?>
