<?php

$article = $table_article->selectOne(array("id"=>$_GET['annonce']));
$rubrique = $table_rubrique->selectOne(array("nomRubrique"=>$article['nomRubrique']));
$utilisateur = $table_utilisateur->selectOne(array("email"=>$article['emailUtilisateur']));
$listeCommentaire = $table_commentaire->selectAllByArticle(array("idArticle"=>$article['id']));

?>

<div class="row align-items-center">
    <div class="col-auto mr-auto">
        <h1> <?php echo $article['titre']  ?> </h1>
    </div>
    <div class="col-auto">
        <?php echo '<img src=" '.$baseWebPath.  $rubrique['image'] . ' " style="max-width:100px" alt="image_rubrique">';?>
    </div>
</div>

<hr/>

<?php
echo '
<div>
    <h5> Posté par ' . $utilisateur['prenom'] . ' ' . $utilisateur['nom'] . ' en ' . $utilisateur['annee'] . ', le ' . $article['dateInscriptionFormatee'] . '  </h5>
    <p>' . $article['infos'] . ' </p>
</div>';
?>
<div>
    <div class="row align-items-center">
        <div class="col-auto mr-auto"> <h3 class="d-inline-block">Commentaires</h3> </div>
        <div class="col-auto"> <?php echo count($listeCommentaire) .' commentaire(s)'; ?> </div>
    </div>
    <hr>
    <form action="">
        <div class="card ">
            <div class="input-group">
                <input type="text" class="form-control mb" name="" id="">
                <div class="input-group-append">
                    <button class="btn btn-outline-dark">Commenter</button>
                </div>
            </div> 
        </div>
    </form>
    <hr>

    <?php

    if(count($listeCommentaire)!=0)
    {
        foreach($listeCommentaire as $id=>$commentaire)
        {

            $utilisateurCom = $table_utilisateur->selectOne(array("email"=>$commentaire['emailUtilisateur']));

            echo'<div class="card">'.
                '   <div class="card-header">'.
                '       <div class="row align-items-center">'.
                '           <div class="col-md-1">'.
                '               <center><img src="' .$baseWebPath. $utilisateurCom['image'] . '"  class="rounded-circle" width="50" height="50" alt="image_utilisateur"/></center>'.
                '           </div>'.
                '           <div class="col-md-11">'.
                '               <h6>  ' . $utilisateurCom['prenom'] . ' ' . $utilisateurCom['nom'] . ', ' . $utilisateurCom['annee'] . '  </h6>'.
                '           </div>'.
                '       </div>'.
                '   </div> '.
                '   <div class="card-body">'.
                '       <p class="card-text ">  ' . $commentaire['contenu'] . '</p>'.
                '   </div>'.
                '    <div class="card-footer">'.
                '        <p class="card-text"> ' . $commentaire['dateCommFormatee'] . '</p>'.
                '    </div>'.
                '</div>'.
                '<br/>';

        }

    } else {

        echo 'Aucun commentaire';

    }

    ?>


</div>






