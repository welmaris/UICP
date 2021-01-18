<!doctype html>
<?php

//require("");
//require("");
//require("");

?>
</style>
<head>
	<title>Inloggen</title>
</head>
<body>
<header>
	<?php echo printheader("Inloggen") ?>
</header>

<h1>Inloggen</h1>

<div>
	<table>
		<form action="" method="post" >
			<tr><td><label for="email">Emailadres:</label></td><td><input type="email" name="email" id="email" required></td></tr>
			<tr><td><label for="wachtwoord">Wachtwoord: </label></td><td><input type="password" name="wachtwoord" id="wachtwoord" required></td></tr>
			<tr><td></td><td><input type="submit" name="login" value="Log in"></td></tr>
		</form>
		<tr><td><p> Nog geen account? </td><td><a href="registreren.php">Registreren<a><br></td></tr>
		<tr><td>Wachtwoord Vergeten? </td><td><a href="wachtwoord_ophalen.php">Klik hier!</a></p></td></tr>
	</table>
</div>

<?php
	
	If(isset($_POST["login"]) && isset($_POST["wachtwoord"]) && isset($_POST["email"])){
		$email_check = check_email($_POST["email"]);

		
		if ($email_check == FALSE){
			$message = "U moet een correct emailadres invoeren!";
		} elseif($_POST["wachtwoord"] == FALSE){
			$message = "U moet een wachtwoord invoeren";
		} else {
			$email = $_POST["email"];
			$wachtwoord = $_POST["wachtwoord"];
			$con = database_connect();
			
			$query = 	"SELECT email
						FROM Klant
						WHERE email = '$email'
						AND wachtwoord_md5 = '$wachtwoord'
						";
			if($query != FALSE){
				$_SESSION["user"] = $email;
				$_SESSION["wachtwoord"] = $wachtwoord;
				header("location: klant_pagina.php", TRUE, 301);
				exit();
			} else {
				$message = "Uw wachtwoord en login komen niet overeen.<br>Probeer opnieuw of klik op wachtwoord vergeten";
			}
			return $message;
		}
		echo $message;
		
	}

?>	
<footer>
	<?php //echo printfooter("Inloggen") ?>
</footer>
</body>
</html>