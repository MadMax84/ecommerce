<?php
require '../include/functions.php';
require './panier.php';

if(isset($_GET['id'])){
    $bdd->query('SELECT ID_produit FROM produits WHERE id=');
} else {
    die('vous n\'avez pas sélectionné de produit à ajouter au panier');
}

?>
