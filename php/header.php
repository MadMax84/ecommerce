<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>GrindHouse Leather</title>
        <link href="styles/styles.css" rel="stylesheet" type="text/css" /> 
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    </head>
    <body>
        <div class="login">
            <form action="./php/login.php" method="post">
                <label for="login">Login</label>
                <input name="login" type="text" class="login" id="login"/>
                <label for="pass">Mot de passe</label>
                <input name="pass" type="password" class="login" id="pass"/>
                <input name="connexion" type="submit" class="login" id="se_connecter"/>
            </form>
            <a href="./php/inscription.php">Pas encore inscrit?</a>
