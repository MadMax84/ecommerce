<?php require "include/header.php"; ?>
<?php require "include/functions.php"; ?>

<section id="conteneur">
    <?php
    $catalogues = $bdd->query('SELECT cat_libelle, cat_img, ID_catalogue FROM catalogue');
    while ($catalogue = $catalogues->fetch()) {
        $var = trim($catalogue['cat_img'], '"../"');
        $id = $catalogue['ID_catalogue'];
        echo '<div class="imglib">';
        echo '<a href="souscatalogues.php?id=' . $id . '"><img src="' . $var . '" class="cata"></a>';
        echo '<div class="catlibelle">' . $catalogue['cat_libelle'] . '</div>';
        echo '</div>';
    }
    ?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>