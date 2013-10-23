<div id="navbar" class="hidden-phone">
    <ul class="nav nav-pills">
      <li>
        <a class="dropdown-toggle" id="drop4" href="../admin/dashboard.php">Home</a>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Catalogues<b class="caret"></b></a>
        <ul id="menu2" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/liste_catalogues.php">Liste des catalogues</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/liste_souscatalogues.php">Liste des sous-catalogues</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/add_catalogue.php">Ajouter un catalogue</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/add_souscatalogue.php">Ajouter un sous catalogue</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Produits<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/liste_produits.php">Liste des produits</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/add_produit.php">Créer un produit</a></li>
          <li role="presentation" class="divider"></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/import.php">Importer des produits</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/export.php">Exporter des produits</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Gestion de la TVA<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Changer valeur de la TVA</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Promotions<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Créer une promotion</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Appliquer une promotion</a></li>
          <li role="presentation" class="divider"></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Générer un code promo</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Ventes privées<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Créer un catalogue</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Créer un produit privé</a></li>
          <li role="presentation" class="divider"></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Mettre en ligne un catalogue / produit privé</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Clients<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Liste des clients</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Ajouter un client</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Commandes<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Liste des commandes</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Gestion des commandes</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Transports<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Gestion des transporteurs</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" id="drop5" role="button" data-toggle="dropdown" href="#">Slideshow<b class="caret"></b></a>
        <ul id="menu3" class="dropdown-menu" role="menu" aria-labelledby="drop5">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="../admin/add_slideshow.php">Ajouter une image</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="">Supprimer une image</a></li>
        </ul>
      </li>
      <li>
        <a class="dropdown-toggle" id="drop4"><?php echo 'Bonjour '.$_SESSION['login']; ?></a>
      </li>
    </ul>
</div>