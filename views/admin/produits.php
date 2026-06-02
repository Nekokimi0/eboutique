<?php
// ============================================================
// views/admin/produits.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-produits">
    <h1>Gestion des produits</h1>
    <a href="index.php?page=admin_produits&action=ajouter">+ Ajouter un produit</a>

    <?php if (empty($produits)): ?>
        <p>Aucun produit disponible.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                    <tr>
                        <td><img src="public/images/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>" width="50"></td>
                        <td><?= $produit['nom'] ?></td>
                        <td><?= $produit['prix'] ?> €</td>
                        <td><?= $produit['quantite'] ?></td>
                        <td>
                            <?php foreach ($categories as $categorie): ?>
                                <?php if ($categorie['id_categorie_produit'] === $produit['id_categorie_produit']): ?>
                                    <?= $categorie['nom'] ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <a href="index.php?page=admin_produits&action=modifier&id=<?= $produit['id_produit'] ?>">Modifier</a>
                            <a href="index.php?page=admin_produits&action=supprimer&id=<?= $produit['id_produit'] ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
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
