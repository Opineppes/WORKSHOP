<?php

$rubrique = $table_rubrique->selectOne(array("nomRubrique"=>$_GET['rubrique']));


function generateForm($infos) {
	$res = "<div id=\"form-rubrique\">";
		
	foreach(json_decode(utf8_encode($infos)) as $id=>$label) {
		$args = explode("_", $id);
		
		switch($args[0]) {
			case "D":
				$res .= "<div class=\"input-group\">".
						"<div class=\"input-group-prepend\">".
						"<span class=\"input-group-text\">". $label ."</span>".
						"</div>".
						"<input type=\"date\" class=\"form-control bxs-dark\" id=\"". $args[1] ."\"/>".
						"</div>";
				break;
			case "@":
				$res .= "<div class=\"input-group\">".
						"<div class=\"input-group-prepend\">".
						"<span class=\"input-group-text\">". $label ."</span>".
						"</div>".
						"<input type=\"text\" class=\"form-control bxs-dark\" id=\"". $args[1] ."\"/>".
						"</div>";
				break;
			case "H":
				$res .= "<div class=\"input-group\">".
						"<div class=\"input-group-prepend\">".
						"<span class=\"input-group-text\">". $label ."</span>".
						"</div>".
						"<input id=\"h-".$args[1]."\" type=\"number\" class=\"form-control bxs-dark\" min=\"0\" max=\"23\"  value=\"12\"/><input id=\"m-".$args[1]."\" type=\"number\" class=\"form-control bxs-dark\" min=\"0\" max=\"59\" value=\"00\"/>".
						"</div>";
				break;
			case "S":
				$res .= "<div class=\"input-group\">".
						"<div class=\"input-group-prepend\">".
						"<span class=\"input-group-text\">". $label ."</span>".
						"</div>".
						"<input type=\"text\" class=\"form-control bxs-dark\" id=\"". $args[1] ."\"/>".
						"</div>";
				break;
		}
		$res .= "<br/>";
	}
	$res .= "</div>";
	
	return $res;
}

?>

<div class="row align-items-center">
    <div class="col-auto mr-auto">
        <h1> <?php  echo $rubrique['nomRubrique'] ;  ?> </h1>
    </div>
    <div class="col-auto">
        <?php echo '<img src=" '.$baseWebPath . $rubrique['image'] . ' " style="max-width:100px" alt="image_rubrique">'; ?>
    </div>
</div>
<form method="get" action="<?php echo $baseWebPath; ?>">
    <div class="input-group mb-3">
    
        <input type="hidden" value="rubrique" name="page"/>
        <input type="hidden" value="<?php echo $rubrique['nomRubrique']; ?>" name="rubrique"/>
        
        <input type="text" class="form-control" name="search" placeholder="Ville, activitée..." aria-label="recherche" aria-describedby="button-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-dark" type="submit" id="button-addon2">Chercher</button>
        </div>
    
    </div>
</form>
<hr>
<div class="d-flex justify-content-center">
    <button class="btn btn-outline-dark w-75" data-toggle="modal" data-target="#rubrique">Ajouter une annonce</button>
</div>

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
<?php echo generateForm($rubrique['infos']) ?>
            </div>
            <div class="modal-footer">
				<button type="submit" class="btn btn-outline-info w-50">Confirmer</button>
			</div>
        </form>
        </div>
    </div>
</div>
<hr>


<table class="table table-hover">
    <tbody>
<?php


if(isset($_GET['search'])) {

    $listArticles = $table_article ->search(array("test"=>"%".$_GET['search']."%", "nomRubrique"=>$rubrique['nomRubrique']) );
    if(count($listArticles)!=0)
    {
        foreach($listArticles as $id=>$article)
        {

            $utilisateur = $table_utilisateur->selectOne(array("email"=>$article['emailUtilisateur']));
            $listeCommentaire = $table_commentaire ->selectAllByArticle(array("idArticle"=>$article['id']));

            //'       <a href=' .$baseWebPath. '?page=profil&profil='. $user['email'] .' class="lien_profil"> '.
            echo '<div class="card">'.
                '   <div class="card-header">'.
                '      <h3 class="class-title text-center"> ' . $article['titre'] . ' </h3>'.
                '   </div>'.
                '   <div class="card-body">'.
                '      <p class="card-text"> ' . $article['infos'] . ' </p>'.
                '      <a href="'.$baseWebPath.'?page=annonce&annonce='. $article['id'] .'" class="btn btn-sm btn-outline-info">Informations</a>'.
                '   </div>'.
                '   <div class="card-footer">'.
                '      <div class="row align-items-center">'.
                '          <p class="card-text">'.
                '          <div class="col-auto mr-auto"> Posté par ' . $utilisateur['prenom'] . ', le ' . $article['dateInscriptionFormatee'] . ' </div>'.
                '          <div class="col-auto"> '; echo count($listeCommentaire); echo ' commentaire(s) </div>'.
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
                '      <p class="card-text"> ' . $article['infos'] . ' </p>'.
                '      <a href="'.$baseWebPath.'?page=annonce&annonce='. $article['id'] .'" class="btn btn-sm btn-outline-info">Informations</a>'.
                '   </div>'.
                '   <div class="card-footer">'.
                '      <div class="row align-items-center">'.
                '          <p class="card-text">'.
                '          <div class="col-auto mr-auto"> Posté par ' . $utilisateur['prenom'] . ', le ' . $article['dateInscriptionFormatee'] . ' </div>'.
                '          <div class="col-auto"> '; echo count($listeCommentaire); echo ' commentaire(s) </div>'.
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

    </tbody>
</table>