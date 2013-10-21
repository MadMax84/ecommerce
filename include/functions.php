<?php

try {
    $bdd = new PDO('mysql:host=localhost;dbname=grindhouse', 'root', '');
} catch (Exception $e) {
    die('erreur :' . $e->getMessage());
}
?>