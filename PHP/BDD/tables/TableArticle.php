<?php

class TableArticle extends Table {
	
	protected $_getAllByUser ; 
	protected $_getAllByRubrique ;

	public function __construct()
	{
		parent::__construct("article" ,array("id"), array("titre", "dateCreation", "infos","emailUtilisateur","nomRubrique"));
		$this->_getAllByUser = "SELECT *, DATE_FORMAT(dateCreation, 'Le %d %M %Y') AS dateInscriptionFormatee FROM article WHERE emailUtilisateur = :emailUtilisateur ORDER BY dateCreation DESC";
		$this->_getAllByRubrique = "SELECT * FROM article WHERE nomRubrique = :nomRubrique";
	}

	public function getAllByUser($args) {
		$req = BDD::getBDD()->prepare($this->_getAllByUser);
			
		$req->execute($args);
		
		return $req->fetchAll();
	}

	public function getAllByRubrique($args) {
		$req = BDD::getBDD()->prepare($this->_getAllByRubrique);
			
		$req->execute($args);
		
		return $req->fetchAll();
	}

}

?>