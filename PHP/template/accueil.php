<h1> Rubriques </h1>
<hr/>
<div class="card-deck">
<?php
	foreach($rubriques as $id=>$rubrique) {
		echo "<div class=\"card\">".
			 "<img class=\"card-img-top\"  width=\"256\" height=\"256\" src=\"". $baseWebPath . $rubrique["image"] ."\" alt=\"Card image cap\">".
			 "<div class=\"card-body\">".
			 "<h5 class=\"card-title\">". $rubrique["nomRubrique"] ."</h5>".
			 "<p class=\"card-text\">". $rubrique["description"] ."</p>".
			 "</div>".
			 "<div class=\"card-footer\">".
			 "<a href=\"". $baseWebPath ."?page=rubrique&rubrique=". $rubrique["nomRubrique"] ."\" class=\"btn btn-sm btn-outline-dark\" style=\"width: 100%\">Visiter</a>".
			 "</div>".
			 "</div>";
	}
?>
</div>