<?php
	$infos = $user;
	if(isset($_GET['profil'])) {
		if($table_utilisateur->exist(array("email"=>$_GET['profil']))) {
			$infos = $table_utilisateur->selectOne(array("email"=>$_GET['profil']));
		} else {
			$_SESSION['error'] = "Utilisateur inconue.";
		}
	}

?>

<h1> Profil </h1>
<hr/>
<div>
    <div class="row">
        <div class="col-md-4">
            <center class="avatar">
<?php
	if($_SESSION['email'] == $infos['email'] or $user['admin'] == "1") {
		echo "<img src=\"" . $baseWebPath . $infos['image'] . "\" width=\"250\" height=\"250\" alt=\"image_profil\" id=\"avatar-img\"/>".
			 "<div id=\"modif-avatar\">Modifier</div>".
			 "<form id=\"form-avatar\">".
			 "<input type=\"file\" style=\"visibility: hidden;\" name=\"avatar\" id=\"avatar\" accept=\".jpg, .jpeg, .png, .gif\"/>".
			 "<input type=\"hidden\" value=\"" . $infos['email'] . "\" name=\"email\"/>".
			 "<input type=\"hidden\" value=\"modif-avatar\" name=\"protocole\"/>".
			 "</form>";
	} else {
		echo "<img src=\"" . $baseWebPath . $infos['image'] . "\" width=\"250\" height=\"250\" alt=\"image_profil\"/>";
	}
?>
			</center>
        </div>
        <div class="col-md-8">
			<form id="modifprofil-form">
				<span class="row"> <span class="col-md-2"> <h5> Nom </h5> </span> <span class="col-md-10" id="profil-Nom"><?php echo $infos['nom']; ?></span> </span>
				<hr/>
				<span class="row"> <span class="col-md-2"> <h5> Prenom </h5> </span> <span class="col-md-10" id="profil-Prenom"><?php echo $infos['prenom']; ?></span> </span>
				<hr/>
				<span class="row"> <span class="col-md-2"> <h5> Email </h5> </span> <span class="col-md-10" id="profil-Email"><?php echo $infos['email']; ?></span> </span>
				<hr/>
				<span class="row"> <span class="col-md-2"> <h5> Promo </h5> </span> <span class="col-md-10" id="profil-Promo"><?php echo $infos['annee']; ?></span> </span>
				<hr/>
				<span class="row"> <span class="col-md-2"> <h5> Campus </h5> </span> <span class="col-md-10" id="profil-Campus"><?php echo $infos['campus']; ?></span> </span>
				<hr/>
				<div class="btn-group w-100" id="control-modifprofil">
					<button type="button" class="btn btn-outline-info w-100" data-toggle="modal" data-target="#modifpasswd">Modifier le mot de passe</button>
					<button type="button" class="btn btn-outline-dark w-100" id="modifprofil">Modifier le profil</button>
				</div>
			</form>
        </div>
    </div>
    <hr/>
    <h1> Posts récents de <?php echo $infos['prenom'] . " " . $infos['nom']; ?> </h1>
    <hr/>

<?php 
	$listArticles = $table_article->getAllByUser(array("emailUtilisateur"=>$infos['email']));
	if(count($listArticles)!=0)
	{
		foreach($listArticles as $id=>$article)
		{

			echo '<div class="card w-95">'.
				 '	<div class="card-header">'.
				 '		<h3 class="class-title text-center"> '.$article['titre'].' </h3>'.
				 '	</div>'.
				 '	<div class="card-body">'.
				 '		<p class="card-text">'.$article['infos'].'</p>'.
				 '		<a href="#" class="btn btn-primary">Informations</a>'.
				 '	</div>'.
				 '	<div class="card-footer">'.
				 '		<p class="card-text"> Posté par ' . $infos['prenom'] . ', le ' . $article['dateInscriptionFormatee'] . '</p>'.
				 '	</div>'.
				 '</div>'.
				 '<hr/>';

		}
	} else {
		echo 'Aucun article publié récemment';
	}
?>

</div>

<div class="modal fade" id="modifpasswd" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<form id="modifpasswd-form">
				<div class="modal-header">
					<h5 class="modal-title">Modifier Mot de Passe</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modifpasswd-body">
<?php
		if($user['admin'] != "1") {
			echo '	<div class="form-group">
						<label for="modif-lastpasswd">Ancien Mot de passe</label>
						<input type="password" class="form-control" id="modif-lastpasswd" name="lastpasswd" required />
					</div>';
		}
?>
					<div class="form-group">
						<label for="modif-passwd">Nouveau Mot De Passe</label>
						<input type="password" class="form-control" id="modif-passwd" name="passwd" required />
					</div>
					<div class="form-group">
						<label for="modif-confpasswd">Confirmation Mot De Passe</label>
						<input type="password" class="form-control" id="modif-confpasswd" name="confpasswd" required />
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" name="valider">Changer le mot de passe</button>
				</div>
			</form>
		</div>
	</div>
</div>