<?php
	require "../admin/include/header.php";
?>

<div>
	<form id="formConnect" method="post" action="../admin/include/connexion.php">
		<fieldset>
		<legend>Connexion au back-office</legend>
			<label class="control-label" for="inputIcon">Nom d'utilisateur :</label>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						<input class="span2" id="inputIcon" name="login" type="text">
					</div>
				</div>
			</div>
			<label class="control-label" for="inputIcon2">Mot de passe :</label>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-th"></i></span>
						<input class="span2" id="inputIcon2" name="pwd" type="password">
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary" data-toggle="button">Connexion</button>
		</fieldset>
	</form>
</div>

<?php
	require "../admin/include/footer.php";
?>