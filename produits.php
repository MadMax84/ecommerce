<?php require "include/header.php"; ?>
<?php require "include/functions.php"; ?>

<section id="conteneur">
    <?php
    $id = $_GET['id'];
    $produits = $bdd->query('SELECT distinct nom, prix, quantite, nouveaute, adrImage1 FROM produits p INNER JOIN images i ON p.ID_produit=i.produits_ID_produit WHERE souscatalogue_ID_souscatalogue=' . $id . '');

    while ($produit = $produits->fetch()) {
        $var = trim($produit['adrImage1'], '"../"');
        echo '<div class="imglib">';
        echo'<a href="souscatalogues.php"><img src="' . $var . '" class="cata"></a>';
        echo '<div class="catlibelle">' . $produit['nom'] . '</div>';
        echo '</div>';
    }
    ?>
</section>

    <?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>