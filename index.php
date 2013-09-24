<?php

header('Content-Type: text/html; charset=utf-8');
session_start();
include_once ("./php/connectionBDD/connection.php");

$reponse = $bdd->query('SELECT * FROM Client');

while ($donnees = $reponse->fetch())
{
    echo $donnees['nom'];
}

$reponse->closeCursor();
echo "bouh je débarque! Site over swag en cours";

?>
