<?php
	//load libraries
	require("config.lib.php");
	require("database.lib.php");
	
	$dbConnection = databaseConnect(); // Connect to the database
?>

<head>
	<title>Login</title>
</head>

<body>
<h1>Login</h1>

<div>
	<table>
		<form action="" method="post" >
			<tr><td><label for="email">Email address:</label></td><td><input type="email" name="email" id="email" required></td></tr>
			<tr><td><label for="password">Password: </label></td><td><input type="password" name="password" id="password" required></td></tr>
			<tr><td></td><td><input type="submit" name="login" value="Log in"></td></tr>
		</form>
	</table>
</div>

<b></br>Contact the administrator if you want to reset your password</b>

<?php


If(isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["email"])){
    
    if($_POST["email"] == FALSE){
    $message = "You must enter a username";
    } elseif($_POST["password"] == FALSE){
        $message = "You must enter a password";
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];
        
        $query = 	"SELECT username
                    FROM accounts
                    WHERE username = '$email'
                    AND password = '$password'
                    ";
                    

        $result_set = mysqli_query($dbConnection, $query);

        
        //while($record = mysqli_fetch_assoc($result_set)){
        //    var_dump($record);
        //}

        //var_dump($result_set);

        if(mysqli_num_rows($result_set) == 1 ){
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            header("location: pakistan.html", TRUE, 301);
            exit();
        } else {
            //$message = "Uw password en login komen niet overeen.<br>Probeer opnieuw of klik op wachtwoord vergeten";
            //echo $message;
        }
    }
}
mysqli_free_result($result_set);
databaseDisconnect($dbConnection); // disconnect from database
?>	
</body>
</html>

