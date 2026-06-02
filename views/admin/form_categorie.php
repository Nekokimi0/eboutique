<?php
// ============================================================
// views/admin/form_categorie.php — Ajout / Modification catégorie
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-form">
    <h1><?= isset($categorie) ? 'Modifier la catégorie' : 'Ajouter une catégorie' ?></h1>

    <form method="POST" action="index.php?page=admin_categories&action=<?= isset($categorie) ? 'modifier&id=' . $categorie['id_categorie_produit'] : 'ajouter' ?>">
        <label>Nom</label>
        <input type="text" name="nom" value="<?= $categorie['nom'] ?? '' ?>" required>

        <button type="submit"><?= isset($categorie) ? 'Modifier' : 'Ajouter' ?></button>
        <a href="index.php?page=admin_categories">Annuler</a>
    </form>
</section>

<?php
require 'views/templates/footer.php';
?>
