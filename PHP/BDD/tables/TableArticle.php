<?php

class TableArticle extends Table {
	
	public function __construct()
	{
		parent::__construct("article" ,array("id"), array("dateCreation", "infos","emailUtilisateur","nomRubrique"));
	}
}

?>