<?php

$rubrique = $table_rubrique->selectOne(array("nomRubrique"=>$_GET['rubrique']));


function generateForm($infos) {
	$res = "<div id=\"article-infos\">";
		
	foreach(json_decode(utf8_encode($infos)) as $id=>$label) {
		$args = explode("_", $id);
		
		switch($args[0]) {
			case "D":
				$res .= "<div class=\"input-group\" id=\"". $id ."\">".
						"<div class=\"input-group-prepend\" style=\"width: 180px;\">".
						"<span class=\"input-group-text w-100\">". $label ."</span>".
						"</div>".
						"<input type=\"date\" class=\"form-control bxs-dark\" required/>".
						"</div>";
				break;
			case "A":
				$res .= "<div class=\"input-group\" id=\"". $id ."\">".
						"<div class=\"input-group-prepend\" style=\"width: 180px;\">".
						"<span class=\"input-group-text w-100\" >". $label ."</span>".
						"</div>".
						"<input type=\"text\" placeholder=\"23 Rue du Dépot, 62000 Arras\" class=\"form-control bxs-dark\" required/>".
						"</div>";
				break;
			case "H":
				$res .= "<div class=\"input-group\" id=\"". $id ."\">".
						"<div class=\"input-group-prepend\" style=\"width: 180px;\">".
						"<span class=\"input-group-text w-100\">". $label ."</span>".
						"</div>".
						"<input type=\"number\" class=\"form-control bxs-dark h\" min=\"0\" max=\"23\" value=\"12\" required/>".
						"<input type=\"number\" class=\"form-control bxs-dark m\" min=\"0\" max=\"59\" value=\"00\" required/>".
						"</div>";
				break;
			case "S":
				$res .= "<div class=\"input-group\" id=\"". $id ."\">".
						"<div class=\"input-group-prepend\" style=\"width: 180px;\">".
						"<span class=\"input-group-text w-100\">". $label ."</span>".
						"</div>".
						"<input type=\"text\" placeholder=\"texte\"class=\"form-control bxs-dark\" required/>".
						"</div>";
				break;
		}
		$res .= "<br/>";
	}
	$res .=	"</div>";
	
	return $res;
}

?>

<div class="modal fade" id="rubrique" tabindex="-1" role="dialog" aria-labelledby="article-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form id="article-form">
            <div class="modal-header">
                <h5 class="modal-title">Créer un article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="article-body">
				<input type="hidden" value="<?php echo $rubrique['nomRubrique']; ?>" id="article-rubrique"/>
				<div class="form-group">
					<label for="titre">Titre</label>
					<input type="text" class="form-control bxs-dark" id="titre" placeholder="Titre" required>
				</div>
<?php echo generateForm($rubrique['infos']) ?>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control bxs-dark" id="description" required></textarea>
				</div>
            </div>
            <div class="modal-footer">
				<button type="submit" class="btn btn-outline-info w-50">Confirmer</button>
			</div>
        </form>
        </div>
    </div>
</div>

<div class="row align-items-center">
    <div class="col-auto mr-auto">
        <h1> <?php  echo $rubrique['nomRubrique'] ;  ?> </h1>
    </div>
    <div class="col-auto">
        <?php echo '<img src=" '.$baseWebPath . $rubrique['image'] . ' " width="100" height="100" alt="image_rubrique">'; ?>
    </div>
</div>

<hr>
<div class="row">
	<div class="col-md-8">
		<form method="get" action="<?php echo $baseWebPath; ?>">
			<div class="input-group">
			
				<input type="hidden" value="rubrique" name="page"/>
				<input type="hidden" value="<?php echo $rubrique['nomRubrique']; ?>" name="rubrique"/>
				
				<input type="text" class="form-control" name="search" placeholder="Ville, activitée..." aria-label="recherche" aria-describedby="button-addon2">
				<div class="input-group-append">
					<button class="btn btn-outline-dark" type="submit" id="button-addon2">Chercher</button>
				</div>
			
			</div>
		</form>
	</div>
	<div class="col-md-4">
		<button class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#rubrique">Ajouter une annonce</button>
	</div>
</div>
<hr/>


<?php


if(isset($_GET['search'])) {

    $listArticles = $table_article ->search(array("test"=>"%".$_GET['search']."%", "nomRubrique"=>$rubrique['nomRubrique']) );
    if(count($listArticles)!=0)
    {
        foreach($listArticles as $id=>$article)
        {

            $utilisateur = $table_utilisateur->selectOne(array("email"=>$article['emailUtilisateur']));
            $listeCommentaire = $table_commentaire ->selectAllByArticle(array("idArticle"=>$article['id']));

            echo '<div class="card">'.
                '   <div class="card-header">'.
                '      <h3 class="class-title text-center"> ' . $article['titre'] . ' </h3>'.
                '   </div>'.
                '   <div class="card-body">'.
                '      <p class="card-text"> ' . $article['description'] . ' </p>'.
                '      <div class="row"><div class="ml-auto col-md-3"><a href="'.$baseWebPath.'?page=annonce&annonce='. $article['id'] .'" class="btn btn-sm btn-outline-info w-100">Informations</a></div></div>'.
                '   </div>'.
                '   <div class="card-footer">'.
                '      <div class="row align-items-center">'.
                '          <p class="card-text">'.
                '          <div class="col-auto mr-auto"> Posté par ' . $utilisateur['prenom'] . ' ' . $utilisateur['nom'] . ' en ' . $utilisateur['annee'] . ', le ' . $article['dateInscriptionFormatee']. ' </div>'.
                '          <div class="col-auto"> ' . count($listeCommentaire) . ' commentaire(s) </div>'.
                '          </p>'.
                '      </div> '.    
                '   </div> '.
                '</div>'.
                '<br>';
    
        }
    } else {
        echo 'Aucun article ne correspond à la recherche';
    }

} else {

    $listArticles =$table_article ->getAllByRubrique (array("nomRubrique"=>$rubrique['nomRubrique']));

    if(count($listArticles)!=0)
    {
        foreach($listArticles as $id=>$article)
        {

            $utilisateur = $table_utilisateur->selectOne(array("email"=>$article['emailUtilisateur']));
            $listeCommentaire = $table_commentaire ->selectAllByArticle(array("idArticle"=>$article['id']));

            echo '<div class="card">'.
                '   <div class="card-header">'.
                '      <h3 class="class-title text-center"> ' . $article['titre'] . ' </h3>'.
                '   </div>'.
                '   <div class="card-body">'.
                '      <p class="card-text"> ' . $article['description'] . ' </p>'.
                '      <div class="row"><div class="ml-auto col-md-3"><a href="'.$baseWebPath.'?page=annonce&annonce='. $article['id'] .'" class="btn btn-sm btn-outline-info w-100">Informations</a></div></div>'.
                '   </div>'.
                '   <div class="card-footer">'.
                '      <div class="row align-items-center">'.
                '          <p class="card-text">'.
                '          <div class="col-auto mr-auto"> Posté par ' . $utilisateur['prenom'] . ' ' . $utilisateur['nom'] . ' en ' . $utilisateur['annee'] . ', le ' . $article['dateInscriptionFormatee']. ' </div>'.
                '          <div class="col-auto"> ' . count($listeCommentaire) . ' commentaire(s) </div>'.
                '          </p>'.
                '      </div> '.    
                '   </div> '.
                '</div>'.
                '<br>';

        }
    } else {
        echo 'Aucun article publié récemment';
    }
}
?>