<!doctype html>

<html>
<body>

<div>
    <p>Please fill out this form to reset your password.</p>
	<form action="" method="post">
		<table>
			<tr><td><label for="password">New password:</label></td><td><input type="password" name="password" id="password" ></td></tr>
			<tr><td><label for="confirmation">Confirm password:</td><td><input type="password" name="confirmation" id="confirmation"></td></tr>
			<tr><td></td><td><input type="submit" name="Reset password" value="Reset"></td></tr>
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