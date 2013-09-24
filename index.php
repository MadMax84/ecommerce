<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>GrindHouse Leather</title>
    </head>
    <body>
        <div id="corps">
			<!-- PENSER A MODIFIER L'ADRESSE MAIL AVANT LE RENDU -->
			<form id="form" action="mailto:moi@bouh.com" method="post" enctype="application/x-www-form-urlencoded"> 
				<table>
					<th colspan="2"> <h1> Formulaire d'inscription </h1> </th>
					<tr>
						<td> <label for="identifiant"> Identifiant </label> </td>
						<td> <input type="text" name="id" value="" id="identifiant" required/> </td>
					</tr>
					<tr>
						<td> <label> Civilité (sexe) </label> </td>
						<td> <input type="radio" name="sexe" value="" id="homme"/> <label for="homme"> Homme </label> <br/>
                                                     <input type="radio" name="sexe" value="" id="femme"/> <label for="femme"> Femme </label> </td> 
					</tr>
					<tr>
						<td> <label for="mail"> E-mail </label></td>
						<td> <input type="email" name="mail" value="" id="mail" required/> </td>
					</tr>
					<tr>
						<td> <label for="psw"> Mot de passe </label> </td>
						<td> <input type="password" name="psw" value="" id="psw" required/> </td> 
					</tr>
					<tr>
						<td> <label for="pswverif"> Vérification de mot de passe </label> </td>
						<td> <input type="password" name="pswverif" value="" id="pswverif" required/> </td>
					</tr>
					<tr>
						<td> <label for="tel"> Téléphone </label> </td>
						<td> <input type="tel" name="tel" value="" id="tel" required/> </td>
					</tr>
					<tr>
						<td> <label> Pays </label> </td>
						<td> 
                                                    <select name="pays">
                                               		<option>France</option>
							<option>Allemagne</option>
							<option>Italie</option>
							<option>Espagne</option>
                                                    </select>
						</td>
					</tr>
					<tr>
                                            <td colspan="2"> <label for="cgu"> Conditions générales </label> <input type="checkbox" name="cgu" id="cgu"/> </td>
					</tr>
					<tr>
						<td colspan="2"> <input type="submit" value="Enregistrer"/> </td>
					</tr>
				</table>
			</form>
		</div>
        <?php
            echo "bouh je débarque! Site over swag en cours";
        ?>
    </body>
</html>
