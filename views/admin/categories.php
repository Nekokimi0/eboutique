<?php
// ============================================================
// views/admin/categories.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-categories">
    <h1>Gestion des catégories</h1>
    <a href="index.php?page=admin_categories&action=ajouter">+ Ajouter une catégorie</a>

    <?php if (empty($categories)): ?>
        <p>Aucune catégorie disponible.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $categorie): ?>
                    <tr>
                        <td><?= $categorie['nom'] ?></td>
                        <td>
                            <a href="index.php?page=admin_categories&action=modifier&id=<?= $categorie['id_categorie_produit'] ?>">Modifier</a>
                            <a href="index.php?page=admin_categories&action=supprimer&id=<?= $categorie['id_categorie_produit'] ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
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
