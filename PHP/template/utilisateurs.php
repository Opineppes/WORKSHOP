<div class="col-auto mr-auto">
    <h1> Utilisateurs </h1>
    <form method="get" action="<?php echo $baseWebPath;  ?>">
    <div class="input-group mb-3">
    
        <input type="hidden" value="utilisateurs" name="page"/>
        <input type="text" class="form-control" name="search" placeholder="Chercher quelqu'un (nom, prenom, ...)" aria-label="Chercher quelqu'un" aria-describedby="button-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-dark" type="submit" id="button-addon2">Chercher</button>
        </div>
    
    </div>
    </form>
</div>

<table class="table table-hover">
    <tbody>

<?php 

if(isset($_GET['search'])) {

    $listUser = $table_utilisateur ->search(array("test"=>"%".$_GET['search']."%"));
    if(count($listUser)!=0)
    {
        foreach($listUser as $id=>$user)
        {
            //'       <a href=' .$baseWebPath. '?page=profil&profil='. $user['email'] .' class="lien_profil"> '.
            echo"<tr class=\"lien_profil\" onclick=\"document.location='" .$baseWebPath. '?page=profil&profil='. $user['email'] . "';\">".
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
        echo 'Aucun utilisateur ne correspond à la recherche';
    }

} else {

    $listUser = $table_utilisateur ->selectAll ();

    if(count($listUser)!=0)
    {
        foreach($listUser as $id=>$user)
        {
    
            echo"<tr class=\"lien_profil\" onclick=\"document.location='" .$baseWebPath. '?page=profil&profil='. $user['email'] . "';\">".
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

}



?>
    </tbody>
</table>