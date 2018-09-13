<div class="col-auto mr-auto">
    <h1> Utilisateurs </h1>
    
</div>

<table class="table">
    <tbody>

<?php 

$listUser = $table_utilisateur ->selectAll ();

if(count($listUser)!=0)
{
	foreach($listUser as $id=>$user)
	{

        echo'<tr >'.
            '   <td >'.
            '        <center><img src="' .$baseWebPath. $user['image'] . '"  class="rounded-circle" width="100" height="100" alt="image_utilisateur"/></center>'.
            '   </td>'.
            '   <td >'.
            '        <h4> ' . $user['prenom'] . ' ' . $user['nom'] . ' </h4>'.
            '        <h5> ' . $user['email'] . ' </h5>'.
            '        <p> Campus de ' . $user['campus'] . ', en classe de ' . $user['annee'] . ' </p>'.
            '    </td>'.
            '</tr>';

	}
} else {
	echo 'Aucun utilisateur';
}

?>
    </tbody>
</table>