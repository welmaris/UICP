<!doctype html>

<html>
<body>

<div>
	<form action="" method="post">
		<table>
			<tr><td><label for="wachtwoord">Nieuw Wachtwoord:</label></td><td><input type="password" name="wachtwoord" id="wachtwoord" ></td></tr>
			<tr><td><label for="herhaling">Herhaal Wachtwoord:</td><td><input type="password" name="herhaling" id="herhaling"></td></tr>
			<tr><td></td><td><input type="submit" name="ww_wijzigen" value="Wijzig"></td></tr>
		</table>
	</form>
</div>

<?php
	if(isset($_POST["ww_wijzigen"])){
		if($_POST["wachtwoord"] != NULL){
			$ww = check_wachtwoord($_POST["wachtwoord"]);
		} else {
			echo "U moet wel een nieuw wachtwoord opgeven";
		}
		if($_POST["wachtwoord"] != $_POST["herhaling"]){
			$check = FALSE;
			echo "Wachtwoord komt niet overeen.<br>";
		} else {
			$check = TRUE;
		}
		
		if($ww != FALSE && $check != FALSE){
			$wachtwoord = $_POST["wachtwoord"];
			$con = database_connect();
			
			$query = 	"UPDATE klant
						SET wachtwoord_md5 = {$wachtwoord}
						WHERE email = {given email from }"; //email gehaald via link of via login (sessions)
		} else {
			echo "U moet wel juist informatie invoeren";
		}
	}
	
	

?>

<footer>
	<?php //echo printfooter("Wachtwoord wijzigen") ?>
</footer>
</body>
</html>