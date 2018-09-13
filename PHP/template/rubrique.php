<?php

$rubrique = $table_rubrique->selectOne(array("nomRubrique"=>$_GET['rubrique']));

?>

<div class="row align-items-center">
    <div class="col-auto mr-auto">
        <h1> <?php  echo $rubrique['nomRubrique'] ;  ?> </h1>
    </div>
    <div class="col-auto">
        <?php echo '<img src=" '.$baseWebPath . $rubrique['image'] . ' " style="max-width:100px" alt="image_rubrique">'; ?>
    </div>
</div>
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
                <div class="form-group">
                    <label for="titre">Titre</label>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
            </div>
            <div class="modal-footer">
				<button type="submit" class="btn btn-outline-info w-50">Confirmer</button>
			</div>
        </form>
        </div>
    </div>
</div>
<hr>

<?php


$listArticles =$table_article ->getAllByRubrique (array("nomRubrique"=>$rubrique['nomRubrique']));

if(count($listArticles)!=0)
{
	foreach($listArticles as $id=>$article)
	{

        $utilisateur = $table_utilisateur->selectOne(array("email"=>$article['emailUtilisateur']));
        $listeCommentaire = $table_commentaire ->selectAllByArticle(array("idArticle"=>$article['id']));

        echo '<div class="card">'.
             '   <div class="card-body">'.
             '      <h3 class="class-title text-center"> ' . $article['titre'] . ' </h3>'.
             '      <hr>'.
             '      <p class="card-text"> ' . $article['infos'] . ' </p>'.
             '      <a href="'.$baseWebPath.'?page=annonce&annonce='. $article['id'] .'" class="btn btn-primary">Informations</a>'.
             '   </div>'.
             '   <div class="card-footer">'.
             '      <div class="row align-items-center">'.
             '          <p class="card-text">'.
             '          <div class="col-auto mr-auto"> Posté par ' . $utilisateur['prenom'] . ', le ' . $article['dateInscriptionFormatee'] . ' </div>'.
             '          <div class="col-auto"> '; echo count($listeCommentaire); echo ' commentaire(s) </div>'.
             '          </p>'.
             '       </div>'.
             '   </div> '.
             '</div>'.
             '<br>';

	}
} else {
	echo 'Aucun article publié récemment';
}

?>
