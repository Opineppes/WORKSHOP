<?php

class TableUtilisateur extends Table {
	
	protected $_valid;
	protected $_exist;
	
	public function __construct()
	{
		parent::__construct("utilisateur" ,array("email"), array("prenom", "nom","annee","admin", "image", "mdp"));
		$this->_exist = "SELECT * FROM utilisateur WHERE email = :email";
		$this->_valid = "SELECT * FROM utilisateur WHERE email = :email and mdp = :mdp";
		$this->_create = "INSERT INTO utilisateur(email, prenom, nom, annee, mdp) VALUES (:email, :prenom, :nom, :annee, :mdp);";
	}
	
	public function exist($args) {
		$req = BDD::getBDD()->prepare($this->_exist);
			
		$req->execute($args);
		
		return $req->rowCount() > 0;
	}
	
	public function valid($args) {
		$req = BDD::getBDD()->prepare($this->_valid);
			
		$req->execute($args);
		
		return $req->rowCount() > 0;
	}
}

?>