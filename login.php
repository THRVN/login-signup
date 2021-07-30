<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php
		require('config.php');
		session_start();

		if (isset($_POST['username'])){
			$username = stripslashes($_REQUEST['username']);
			$username = mysqli_real_escape_string($bdd, $username);
			$_SESSION['username'] = $username;
			$password = stripslashes($_REQUEST['password']);
			$password = mysqli_real_escape_string($bdd, $password);
			$query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
			$result = mysqli_query($bdd,$query) or die('mysql_error'());
			
			if (mysqli_num_rows($result) == 1) {
				$user = mysqli_fetch_assoc($result);
				// vérifier si l'utilisateur est un administrateur ou un utilisateur
				if ($user['type'] == 'admin') {
					header('location: admin/admin.php');		  
				}else{
					header('location: index.php');
				}
			}else{
				$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
			}
		}
		?>
		<form class="box" action="" method="post" name="login">
			<h1 class="box-logo box-title">
				<a href="index.php">Login</a>
			</h1>
			<h1 class="box-title">Connexion</h1>
			<input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
			<input type="password" class="box-input" name="password" placeholder="Mot de passe">
			<input type="submit" value="Connexion " name="submit" class="box-button">
			<p class="box-register">Vous êtes nouveau ici ? <a href="register.php">Inscrivez-vous ici</a></p>
			<br>
			<p class="login-p">Nom d'utilisateur : <strong>Admin</strong><br>Mot de passe : <strong>admin</strong></p>
			<br>
			<div style="text-align: center;">
				<a href="https://github.com/THRVN" target="_blank"><img src="img/logo-github.png" alt="Logo github">
					<br>
					<p style="font-size: small;">&copy; THRVN</p>
				</a>
			</div>
			<?php if (! empty($message)) { ?>
				<p class="errorMessage"><?php echo $message; ?></p>
			<?php } ?>
		</form>
	</body>
</html>