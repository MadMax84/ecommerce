<?php
include_once ("config.ini.php");
try{
    $bdd = new PDO('mysql:host=$host;dbname=$bdd;', $user, $pass);
}
catch(Exception $e)
{
    die('Erreur :' .$e->getMessage());
}

?>
