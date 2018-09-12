<?php

class TableCommentaire extends Table {
	
	public function __construct()
	{
		parent::__construct("commentaire" ,array("id"), array("contenu", "dateHeure","emailUtilisateur"));
	}
}

?>