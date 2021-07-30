<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Register</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php
		require('config.php');

		if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password'])){
			// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
			$username = stripslashes($_REQUEST['username']);
			$username = mysqli_real_escape_string($conn, $username); 
			// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($conn, $email);
			// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($conn, $password);
			
			$query = "INSERT into `users` (username, email, type, password)
						VALUES ('$username', '$email', 'user', '".hash('sha256', $password)."')";
			$res = mysqli_query($conn, $query);

			if($res){
			echo "<div class='sucess'>
					<h3>Vous êtes inscrit avec succès.</h3>
					<p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
					</div>";
			}
		}else{
		?>
		<form class="box" action="" method="post">
			<h1 class="box-logo box-title">
				<a href="index.php">Register</a>
			</h1>
			<h1 class="box-title">S'inscrire</h1>
			<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
			<input type="text" class="box-input" name="email" placeholder="Email" required />
			<input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
			<input type="submit" name="submit" value="S'inscrire" class="box-button" />
			<p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
			<br>
			<div style="text-align: center;">
				<a href="https://github.com/THRVN" target="_blank"><img src="img/logo-github.png" alt="Logo github">
					<br>
					<p style="font-size: small;">&copy; THRVN</p>
				</a>
			</div>
		</form>
		<?php } ?>
	</body>
</html>