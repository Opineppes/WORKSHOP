<nav class="navbar fixed-top navbar-expand-md navbar-light fi" style="background-color: #dedfe0;">
	<a class="navbar-brand" href="/">
	<img src="/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
	Campus Life
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="/">Accueil <span class="sr-only">(current)</span></a>
			</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="rubriques" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Rubriques
			</a>
			<div class="dropdown-menu align-items-center" aria-labelledby="rubriques">
<?php

	foreach($rubriques as $id=>$rubrique) {
		echo "<a class=\"dropdown-item\" href=\"/?page=rubrique&rubrique=". $rubrique["nomRubrique"] ."\"> <img src=\"" . $rubrique['image'] . "\" width=\"20\" height=\"20\" alt=\"image_rubrique\" />&nbsp;&nbsp;". $rubrique["nomRubrique"] ."</a>";
	}

?>
			</div>
		</li>
		</ul>
		
		<ul class="navbar-nav">
<?php
	if($user != null) {
		echo "<li class=\"nav-item dropdown\">".
			 "<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">".
			 "<img src=\"" . $user['image'] . "\" width=\"32\" height=\"32\" class=\"rounded-circle\" />&nbsp;Mon Compte&nbsp;" .
			 "</a>".
			 "<div class=\"dropdown-menu\" aria-labelledby=\"rubriques\">".
			 "<a class=\"dropdown-item\" href=\"/?page=profil\">Profil</a>".
			 "<div class=\"dropdown-divider\"></div>".
			 "<a class=\"dropdown-item\" id=\"deconnexion\" href=\"#\">Se déconnecter</a>".
			 "</div>".
			 "</li>";
	} else {
		echo "<li class=\"nav-item\">".
			 "<button type=\"button\" class=\"btn btn-outline-dark\" data-toggle=\"modal\" data-target=\"#connexion-modal\">Se connecter</button>".
			 "</li>";
	}
?>
		</ul>
	</div>
</nav>

<div class="modal fade" id="connexion-modal" tabindex="-1" role="dialog" aria-labelledby="connexion-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form id="connexion-form">
				<div class="modal-header">
					<h5 class="modal-title" id="connexion-modal-title">Connexion</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="connexion-body">
					<div class="form-group">
						<label for="email-connexion">Email</label>
						<input type="text" class="form-control bxs-dark" id="email-connexion" placeholder="exemple@exemple.com" required>
					</div>
					<div class="form-group">
						<label for="mot-de-passe-connexion">Mot de passe</label>
						<input type="password" class="form-control bxs-dark" id="mot-de-passe-connexion" placeholder="Mot de passe" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-info w-50" id="btn-inscription">S'inscrire</button>
					<button type="submit" class="btn btn-outline-dark ml-auto w-50">Se connecter</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="inscription-modal" tabindex="-1" role="dialog" aria-labelledby="inscription-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form id="inscription-form">
				<div class="modal-header">
					<h5 class="modal-title" id="inscription-modal-title">Inscription</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="inscription-body">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control bxs-dark" id="email" placeholder="Exemple@exemple.com" required>
					</div>
					<div class="form-group">
						<label for="mot-de-passe">Mot de passe</label>
						<input type="password" class="form-control bxs-dark" id="mot-de-passe" placeholder="Mot de passe" required>
					</div>
					<div class="form-group">
						<label for="valide-mot-de-passe">Validation du mot de passe</label>
						<input type="password" class="form-control bxs-dark" id="valide-mot-de-passe" placeholder="Mot de passe" required>
					</div>
					<div class="form-group">
						<label for="prenom">Prénom</label>
						<input type="text" class="form-control bxs-dark" id="prenom" placeholder="Prénom" required>
					</div>
					<div class="form-group">
						<label for="nom">Nom</label>
						<input type="text" class="form-control bxs-dark" id="nom" placeholder="Nom" required>
					</div>
					<div class="form-group">
						<label for="annee">Année</label>
						<select  class="form-control bxs-dark" id="annee" required>
							<option value="B1">B1</option>
							<option value="B2">B2</option>
							<option value="B3">B3</option>
							<option value="I4">I4</option>
							<option value="I5">I5</option>
						</select>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-info w-50">S'inscrire</button>
				</div>
			</form>
		</div>
	</div>
</div>