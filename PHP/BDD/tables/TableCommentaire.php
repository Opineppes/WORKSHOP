<?php

class TableCommentaire extends Table {

	protected $_selectAllByArticle;
	
	public function __construct()
	{
		parent::__construct("commentaire" ,array("id"), array("contenu", "dateHeure","emailUtilisateur","idArticle"));
		$this->_selectAllByArticle = "SELECT *, DATE_FORMAT(dateHeure, 'Le %d/%m/%Y à %H:%i') AS dateCommFormatee FROM commentaire WHERE idArticle = :idArticle ORDER BY dateHeure";
	}

	public function selectAllByArticle($args) {
		$req = BDD::getBDD()->prepare($this->_selectAllByArticle);
			
		$req->execute($args);
		
		return $req->fetchAll();
	}

}

?>