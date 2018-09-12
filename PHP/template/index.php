<?php  $rubriques = $table_rubrique->selectAll();  ?>

<!DOCTYPE html>
<html lang="fr">

	<head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="<?php echo $baseWebPath; ?>img/logo.png"/>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $baseWebPath; ?>css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseWebPath; ?>css/style.css">
	</head>

	<body>
		<div class="background-image"></div>
		
		<header>
<?php 
	include( "PHP/template/header.php");
	include( "PHP/template/error_modal.php");
?>
		</header>
		
		<div class="container" id="page-content">
<?php include( "PHP/template/". $page .".php"); ?>
		</div>

		<script type="text/javascript" src="<?php echo $baseWebPath; ?>js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $baseWebPath; ?>js/bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo $baseWebPath; ?>js/script.js"></script>
<?php 	
	if(isset($_SESSION['error'])) {
		echo "<script>".
			 "	$(\"#error-message\").html(\"". str_replace("\"", "\\\"", $_SESSION['error']) ."\");".
			 "	$(\"#modal-error\").modal(\"show\");".
			 "</script>";
		unset($_SESSION['error']);
	} 
?>
	</body>
</html>