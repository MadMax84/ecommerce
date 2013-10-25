<?php require "include/header.php"; ?>
<?php require "include/functions.php"; ?>

<section id="conteneur">
    <?php
    $id = $_GET['id'];
    $produits = $bdd->query('SELECT distinct ID_produit, nom, prix, quantite, nouveaute, adrImage1 
                             FROM produits p INNER JOIN images i ON p.ID_produit=i.produits_ID_produit 
                             WHERE souscatalogue_ID_souscatalogue=' . $id . '');

    while ($produit = $produits->fetch()) {
        $var = trim($produit['adrImage1'], '"../"');
        $id2 = $produit['ID_produit'];
        echo '<div class="imglib">
                <a href="#"><img src="' . $var . '" class="cata"></a>
                <a href="php/addPanier.php?id=' . $id2 . '"> add </a>
                <div class="catlibelle">' . $produit['nom'] . '</div>
              </div>';
    }
    ?>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>