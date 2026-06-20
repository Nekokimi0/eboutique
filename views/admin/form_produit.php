<?php
// ============================================================
// views/admin/form_produit.php — Ajout / Modification produit
// ============================================================

require 'views/templates/header.php';
?>

<section class="admin-form">
    <a href="index.php?page=admin_produits">← Retour aux produits</a>
    <h1><?= isset($produit) ? 'Modifier le produit' : 'Ajouter un produit' ?></h1>

    <form method="POST" action="index.php?page=admin_produits&action=<?= isset($produit) ? 'modifier&id=' . $produit['id_produit'] : 'ajouter' ?>">
        
        <div class="form-group">
            <label>Nom <span class="obligatoire">*</span></label>
            <input type="text" name="nom" placeholder="Nom du manga" value="<?= $produit['nom'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Image (nom du fichier)</label>
            <input type="text" name="image" placeholder="ex: naruto.jpg" value="<?= $produit['image'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label>Prix (€) <span class="obligatoire">*</span></label>
            <input type="number" name="prix" step="0.01" placeholder="ex: 9.99" value="<?= $produit['prix'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Quantité en stock <span class="obligatoire">*</span></label>
            <input type="number" name="quantite" placeholder="ex: 10" value="<?= $produit['quantite'] ?? '' ?>" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" placeholder="Description du manga..."><?= $produit['description'] ?? '' ?></textarea>
        </div>

        <div class="form-group">
            <label>Catégorie <span class="obligatoire">*</span></label>
            <select name="id_categorie_produit" required>
                <option value="">-- Sélectionner une catégorie --</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id_categorie_produit'] ?>"
                        <?= (isset($produit) && $produit['id_categorie_produit'] == $categorie['id_categorie_produit']) ? 'selected' : '' ?>>
                        <?= $categorie['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <p class="mention-obligatoire"><span class="obligatoire">*</span> Champs obligatoires</p>

        <button type="submit"><?= isset($produit) ? 'Modifier' : 'Ajouter' ?></button>
        <a href="index.php?page=admin_produits">Annuler</a>
    </form>
</section>

<?php
require 'views/templates/footer.php';
?>
