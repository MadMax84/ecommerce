<?php require "include/header.php"; ?>
<?php require "include/functions.php";?>

<section id="conteneur">
    <section id="contain">
        <section id="newclient"></section>
		<h1>Formulaire d'inscription</h1>
    <form action='./inscriptionClient.php' method='post'>
        <label for="pseudo">Pseudo</label>
            <input name="pseudo" type="text" class="formulaire_connexion" id="login"/><br />
        <label for="email">E-mail</label>
            <input name="email" type="email" class="formulaire_connexion" id="email"/><br />
        <label for="psw">Mot de passe</label>
            <input name="psw" type="password" class="formulaire_connexion" id="psw"/><br />
        <label for="v_psw">Confirmation du mot de passe</label>
            <input name="v_psw" type="password" class="formulaire_connexion" id="v_psw"/><br />
        <label for="nom">Prenom</label>
            <input name="prenom" type="text" class="formulaire_connexion" id="prenom"/><br />
        <label for="nom">Nom</label>
            <input name="nom" type="text" class="formulaire_connexion" id="nom"/><br />
            <input id="se_connecter" name="bouton_envoi" type="submit" class="formulaire_connexion"/><br />
    </form>
        <section id="loginclient"></section>
    </section>
</section>

<?php require "include/footer.php"; ?>
<?php require "include/formContact.php";?>