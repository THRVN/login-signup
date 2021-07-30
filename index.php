<?php
	// Initialiser la session
	session_start();
	// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<header>
			<!-- L'header de la page -->
		</header>
		<main>
			<div class="sucess">
				<h1>Bienvenue <?php echo $_SESSION['username']; ?> !</h1>
				<p>C'est votre espace utilisateur.</p>
				<a href="logout.php">Déconnexion</a>
			</div>
			<!-- Le main de la page -->
		</main>
		<footer>
			<!-- Le footer de la page -->
		</footer>
	</body>
</html>