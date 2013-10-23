<?php require "include/header.php"; ?>
<?php require "include/functions.php"; ?>

<section id="conteneur">
    <?php
    $catalogues = $bdd->query('SELECT cat_libelle, cat_img, ID_catalogue FROM catalogue');
    while ($catalogue = $catalogues->fetch()) {
        $id = $catalogue['ID_catalogue'];
        echo '<div class="imglib">';
        echo '<a href="souscatalogues.php?id=' . $id . '"><img src="' . $catalogue['cat_img'] . '" class="cata"></a>';
        echo '<div class="catlibelle">' . $catalogue['cat_libelle'] . '</div>';
        echo '</div>';
    }
    ?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>