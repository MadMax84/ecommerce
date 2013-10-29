<?php
require "include/header.php";
require "include/functions.php";
require "php/panier.class.php"
?>
<?php
if (isset($_GET['del'])) {
    $panier->del($_GET['del']);
}
?>

<section id="conteneur">
    <div class="table">
        <div class="rowtitle">
            <span class="name">Nom du produit</span>
            <span class="prix">Prix</span>
            <span class="quantite">quantite</span>
            <span class="sousTotal">Sous total</span>
            <span class="action">Actions</span>
        </div>

        <?php
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $produits = array();
        } else {
            $req = $bdd->prepare('SELECT * FROM produits WHERE ID_produit IN (' . implode(',', $ids) . ')');
            $req->execute();
            $produits = $req->fetchAll(PDO::FETCH_OBJ);
        }
        foreach ($produits as $produit):
            ?>

            <div class="row">
                <span class="name"><?php $produit->nom; ?></span>
                <span class="prix"><?php $produit->prix; ?></span>
                <span class="quantite"><?php $_SESSION['panier'][$produit->ID_produit]; ?></span>
                <span class="sousTotal">Sous total</span>
                <span class="action"><a href="panier.php?del=<?php $produit->ID_produit; ?>" class="del">Suppr</a></span>
            </div>
        <?php endforeach; ?>
    </div>

</section>
<?php require "include/footer.php"; ?>
<?php require "include/formContact.php"; ?>
