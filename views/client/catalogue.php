<?php
// ============================================================
// views/client/catalogue.php — ...
// ============================================================

require 'views/templates/header.php';
?>

<section class="catalogue">
    <!-- Filtres par catégorie -->
    <div class="categories">
        <a href="index.php?page=catalogue">Tous les produits</a>
        <?php foreach ($categories as $categorie): ?>
            <a href="index.php?page=catalogue&id_categorie=<?= $categorie['id_categorie_produit'] ?>">
                <?= $categorie['nom'] ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Grille de produits -->
    <div class="produits">
        <?php if (empty($produits)): ?>
            <p>Aucun produit disponible.</p>
        <?php else: ?>
            <?php foreach ($produits as $produit): ?>
                <div class="produit-card">
                    <img src="public/images/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>">
                    <h3><?= $produit['nom'] ?></h3>
                    <p><?= $produit['prix'] ?> €</p>
                    <a href="index.php?page=produit&id=<?= $produit['id_produit'] ?>">
                        Voir le produit
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php
require 'views/templates/footer.php';
?>
