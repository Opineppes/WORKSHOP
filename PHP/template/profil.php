<?php
	$infos = $user;
	if(isset($_GET['profil'])) {
		if($table_utilisateur->exist(array("email"=>$_GET['profil']))) {
			$infos = $table_utilisateur->selectOne(array("email"=>$_GET['profil']));
		} else {
			$_SESSION['error'] = "Utilisateur inconue.";
			echo "<script>document.location = \"/?page=profil\"</script>";
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
		echo "<img src=\"" . $infos['image'] . "\" width=\"250\" height=\"250\" alt=\"image_profil\" id=\"avatar-img\"/>".
			 "<div id=\"modif-avatar\">Modifier</div>".
			 "<form id=\"form-avatar\">".
			 "<input type=\"file\" style=\"visibility: hidden;\" name=\"avatar\" id=\"avatar\" accept=\".jpg, .jpeg, .png, .gif\"/>".
			 "<input type=\"hidden\" value=\"" . $infos['email'] . "\" name=\"email\"/>".
			 "<input type=\"hidden\" value=\"modif-avatar\" name=\"protocole\"/>".
			 "</form>";
	} else {
		echo "<img src=\"" . $infos['image'] . "\" width=\"250\" height=\"250\" alt=\"image_profil\"/>";
	}
?>
			</center>
        </div>
        <div class="col-md-8"> 
            <span class="row"> <span class="col-md-2"> <h5> Nom </h5> </span> <span class="col-md-10"> <?php echo $infos['nom']; ?> </span> </span>
			<hr/>
			<span class="row"> <span class="col-md-2"> <h5> Prenom </h5> </span> <span class="col-md-10"> <?php echo $infos['prenom']; ?> </span> </span>
			<hr/>
			<span class="row"> <span class="col-md-2"> <h5> Email </h5> </span> <span class="col-md-10"> <?php echo $infos['email']; ?> </span> </span>
			<hr/>
            <span class="row"> <span class="col-md-2"> <h5> Promo </h5> </span> <span class="col-md-10"> <?php echo $infos['annee']; ?> </span> </span>
			<hr/>
        </div>
    </div>
    <hr/>
    <h1> Posts récents de <?php echo $infos['prenom'] . " " . $infos['nom']; ?> </h1>
    <hr/>

	<?php 
	$listArticles =$table_article ->getAllByUser (array("emailUtilisateur"=>$infos['email']));
	if(count($listArticles)!=0)
	{
		foreach($listArticles as $id=>$article)
		{

			echo '<div class="card w-95">'.
				 '	<div class="card-body">'.
				 '		<h3 class="class-title text-center"> '.$article['titre'].' </h3>'.
				 '		<hr>'.
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