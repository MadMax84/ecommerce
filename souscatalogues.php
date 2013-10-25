<?php require "include/header.php"; ?>
<?php require "include/functions.php"; ?>

<section id="conteneur">
    <?php
    $id = $_GET['id'];
    $souscatalogues = $bdd->query('SELECT souscat_libelle, souscat_img, ID_souscatalogue FROM souscatalogue WHERE catalogue_ID_catalogue=' . $id . '');

    while ($catalogue = $souscatalogues->fetch()) {
        $var = trim($catalogue['souscat_img'], '"../"');
        $id2 = $catalogue['ID_souscatalogue'];
        echo '<div class="imglib">';
        echo'<a href="produits.php?id=' . $id2 . '"><img src="' . $var . '" class="cata"></a>';
        echo '<div class="catlibelle">' . $catalogue['souscat_libelle'] . '</div>';
        echo '</div>';
    }
    ?>
</section>

    <?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>