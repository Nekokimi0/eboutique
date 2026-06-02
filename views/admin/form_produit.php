<?php
// ============================================================
// views/admin/form_produit.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-form">
    <h1><?= isset($produit) ? 'Modifier le produit' : 'Ajouter un produit' ?></h1>

    <form method="POST" action="index.php?page=admin_produits&action=<?= isset($produit) ? 'modifier&id=' . $produit['id_produit'] : 'ajouter' ?>">
        <label>Nom</label>
        <input type="text" name="nom" value="<?= $produit['nom'] ?? '' ?>" required>

        <label>Image (nom du fichier)</label>
        <input type="text" name="image" value="<?= $produit['image'] ?? '' ?>">

        <label>Prix (€)</label>
        <input type="number" name="prix" step="0.01" value="<?= $produit['prix'] ?? '' ?>" required>

        <label>Quantité en stock</label>
        <input type="number" name="quantite" value="<?= $produit['quantite'] ?? '' ?>" required>

        <label>Description</label>
        <textarea name="description"><?= $produit['description'] ?? '' ?></textarea>

        <label>Catégorie</label>
        <select name="id_categorie_produit" required>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie['id_categorie_produit'] ?>"
                    <?= (isset($produit) && $produit['id_categorie_produit'] == $categorie['id_categorie_produit']) ? 'selected' : '' ?>>
                    <?= $categorie['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit"><?= isset($produit) ? 'Modifier' : 'Ajouter' ?></button>
        <a href="index.php?page=admin_produits">Annuler</a>
    </form>
</section>

<?php
require 'views/templates/footer.php';
?>
