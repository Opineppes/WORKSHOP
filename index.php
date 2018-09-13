<?php
	$baseWebPath = "/workshopB2/";

	require_once("PHP/BDD/BDD.php");
	require_once("PHP/PROTOCOLE/PROTOCOLE.php");
	
	session_start();
	
	BDD::connectBDD();
	
	$table_rubrique = new TableRubrique();
	$table_utilisateur = new TableUtilisateur();
	$table_article = new TableArticle();
	$table_commentaire = new TableCommentaire();
	
	$user = null;
	if(isset($_SESSION['connect'])) {
		$user = $table_utilisateur->selectOne(array("email"=>$_SESSION['email']));
	}
	
	if(!empty($_POST)) {
		echo PROTOCOLE::chooser();
		exit();
	}
	
	$error = 0;
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
		
		if($page == "accueil") { //utilisateur lambda
		
			include_once("PHP/template/index.php");
			exit(0);
			
		} else if($page == "rubrique" or $page == "profil" or $page == "annonce") { //utilisateur connecté
			
			if($user != null) {
				include_once("PHP/template/index.php");
				exit(0);
			} else {
				$_SESSION['error'] = "Cette page est exclusivement réservé au membres du site, veuillez vous ".
							 "<strong><a href=\"#\" data-toggle=\"modal\" data-target=\"#inscription-modal\">inscrire</a></strong>".
							 " ou vous ".
							 "<strong><a href=\"#\" data-toggle=\"modal\" data-target=\"#connexion-modal\">connecter</a></strong>.";
			}
				
		} else if(false) { //admin obligatoire
			if($user != null and $user['admin'] == "1") {
				include_once("PHP/template/index.php");
				exit(0);
			} else {
				$_SESSION['error'] = "Vous n'avez pas l'autorisation nécessaire pour acceder a cette page.";
			}
			
		} else {
			$_SESSION['error'] = "<strong>Erreur 404</strong>: La page n'existe pas.";
		}
	}

	header('location: '.$baseWebPath.'?page=accueil');
	
?>