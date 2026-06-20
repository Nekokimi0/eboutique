<?php
// ============================================================
// views/admin/form_categorie.php — Ajout / Modification catégorie
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-form">
    <a href="index.php?page=admin_categories">← Retour aux catégories</a>
    <h1><?= isset($categorie) ? 'Modifier la catégorie' : 'Ajouter une catégorie' ?></h1>

    <form method="POST" action="index.php?page=admin_categories&action=<?= isset($categorie) ? 'modifier&id=' . $categorie['id_categorie_produit'] : 'ajouter' ?>">

        <div class="form-group">
            <label>Nom <span class="obligatoire">*</span></label>
            <input type="text" name="nom" placeholder="Nom de la catégorie" value="<?= $categorie['nom'] ?? '' ?>" required>
        </div>

        <p class="mention-obligatoire"><span class="obligatoire">*</span> Champs obligatoires</p>

        <button type="submit"><?= isset($categorie) ? 'Modifier' : 'Ajouter' ?></button>
        <a href="index.php?page=admin_categories">Annuler</a>
    </form>
</section>

<?php
require 'views/templates/footer.php';
?>
