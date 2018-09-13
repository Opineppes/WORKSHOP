<div class="col-auto mr-auto">
    <h1> Utilisateurs </h1>
    <hr>
</div>


<?php 

$listUser = $table_utilisateur ->selectAll ();

if(count($listUser)!=0)
{
	foreach($listUser as $id=>$user)
	{

        echo'<div class="container">'.
            '    <div class="row align-items-center">'.
            '        <div class="col-md-3">'.
            '        <center><img src="' .$baseWebPath. $user['image'] . '"  class="rounded-circle" width="150" height="150" alt="image_utilisateur"/></center>'.
            '        </div>'.
            '        <div class="col-md-6">'.
            '        <h4> ' . $user['prenom'] . ' ' . $user['nom'] . ' </h4>'.
            '        <h5> ' . $user['email'] . ' </h5>'.
            '        <p> Campus de ' . $user['campus'] . ', en classe de ' . $user['annee'] . ' </p>'.
            '    </div>'.
            '</div>'.
            '<br>'.
            '<br>';

	}
} else {
	echo 'Aucun utilisateur';
}

?>