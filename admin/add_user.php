<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin - add user</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
		<?php
		require('../config.php');

		if (isset($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['type'], $_REQUEST['password'])){
			// récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
			$username = stripslashes($_REQUEST['username']);
			$username = mysqli_real_escape_string($bdd, $username); 
			// récupérer l'email et supprimer les antislashes ajoutés par le formulaire
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($bdd, $email);
			// récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($bdd, $password);
			// récupérer le type (user | admin)
			$type = stripslashes($_REQUEST['type']);
			$type = mysqli_real_escape_string($bdd, $type);
			
			$query = "INSERT into `users` (username, email, type, password)
						VALUES ('$username', '$email', '$type', '".hash('sha256', $password)."')";
			$res = mysqli_query($bdd, $query);

			if($res){
			echo "<div class='sucess'>
					<h3>L'utilisateur a été créée avec succés.</h3>
					<p>Cliquez <a href='admin.php'>ici</a> pour retourner à la page d'accueil</p>
					</div>";
			}
		}else{
		?>
		<form class="box" action="" method="post">
			<h1 class="box-logo box-title">
				<a href="index.php">Exercice 4</a>
			</h1>
			<h1 class="box-title">Add user</h1>
			<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
			<input type="text" class="box-input" name="email" placeholder="Email" required />
			<div class="input-group">
				<select class="box-input" name="type" id="type" >
					<option value="" disabled selected>Type</option>
					<option value="admin">Admin</option>
					<option value="user">User</option>
				</select>
			</div>
			<input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
			<input type="submit" name="submit" value="+ Add" class="box-button" />
			<br>
			<div style="text-align: center;">
				<a href="https://github.com/THRVN" target="_blank"><img src="../img/logo-github.png" alt="Logo github">
					<br>
					<p style="font-size: small;">&copy; THRVN</p>
				</a>
			</div>
		</form>
		<?php } ?>
	</body>
</html>