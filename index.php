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
	
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
		
		if($page == "accueil") { //utilisateur lambda
		
			include_once("PHP/template/index.php");
			exit(0);
			
		} else if($page == "rubrique" or $page == "profil" or $page == "annonce") { //utilisateur connecté
			
			if($user != null) {
				// gestion des erreur en rapport au element necessaire au pages
				switch($page) {
					case "rubrique":
						$rubrique = $table_rubrique->selectOne(array("nomRubrique"=>$_GET['rubrique']));
						if($rubrique == false) {
							$_SESSION['error'] = "<strong>Erreur 404</strong>: La page n'existe pas.";
							header('location: '.$baseWebPath.'?page=accueil');
							exit(0);
						}
						break;
					case "profil":
						if(isset($_GET['profil'])) {
							if(!$table_utilisateur->exist(array("email"=>$_GET['profil']))) {
								$_SESSION['error'] = "Utilisateur inconue.";
								header('location: '.$baseWebPath.'?page=accueil');
								exit(0);
							}
						}
						break;
					case "annonce":
						$article = $table_article->selectOne(array("id"=>$_GET['annonce']));
						if($article == false) {
							$_SESSION['error'] = "<strong>Erreur 404</strong>: La page n'existe pas.";
							header('location: '.$baseWebPath.'?page=accueil');
							exit(0);
						}
				}
				
				include_once("PHP/template/index.php");
				exit(0);
			} else {
				$_SESSION['error'] = "Cette page est exclusivement réservé au membres du site, veuillez vous ".
							 "<strong><a href=\"#\" data-toggle=\"modal\" data-target=\"#inscription-modal\" class=\"link-error\">inscrire</a></strong>".
							 " ou vous ".
							 "<strong><a href=\"#\" data-toggle=\"modal\" data-target=\"#connexion-modal\" class=\"link-error\">connecter</a></strong>.";
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