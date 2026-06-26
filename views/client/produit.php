<?php
// ============================================================
// views/client/produit.php — Fiche détail d'un produit
// ============================================================

require 'views/templates/header.php';
?>

<section class="produit">

    <?php if (!$produit): ?>
        <p>Produit introuvable.</p>
    <?php else: ?>

        <div class="produit-image">
            <img src="public/images/<?= $produit['image'] ?>" alt="<?= $produit['nom'] ?>">
        </div>

        <div class="produit-details">
            <h1><?= $produit['nom'] ?></h1>
            <p class="produit-prix"><?= $produit['prix'] ?> €</p>
            <p class="produit-description"><?= $produit['description'] ?></p>

            <?php if ($produit['quantite'] > 0): ?>
                <p class="produit-stock">En stock (<?= $produit['quantite'] ?> disponibles)</p>
                <form method="POST" action="index.php?page=panier&action=ajouter">
                    <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
                    <input type="number" name="quantite" value="1" min="1" max="<?= $produit['quantite'] ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
            <?php else: ?>
                <p class="produit-rupture">Rupture de stock</p>
            <?php endif; ?>

            <a href="index.php?page=catalogue">← Retour au catalogue</a>
        </div>

    <?php endif; ?>

</section>

<?php
require 'views/templates/footer.php';
?>
