<?php
require("config.php");
session_start();
?>

<html>
<style>

body {
	background-color: white;
}

h1 {
	text-align: center;
	position: relative;
	top: 30px;
	border: 3px solid black;
	
}

div {
	text-align:right;
	float: center;
	width: 100px;
	height: 100px;
	
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
  	
	margin: auto;
}
</style>

<head>
	<title>Login</title>
</head>
<body>
<header>
	<?php echo printheader("Login") ?>
</header>

<h1>Login</h1>

<div>
	<table>
		<form action="" method="post" >
			<tr><td><label for="email">Emailaddress:</label></td><td><input type="email" name="email" id="email" required></td></tr>
			<tr><td><label for="password">Password: </label></td><td><input type="password" name="password" id="password" required></td></tr>
			<tr><td></td><td><input type="submit" name="login" value="Log in"></td></tr>
		</form>
		<tr><td>Forgotten password? </td><td><a href="forgotten_password.php">Klik hier!</a></p></td></tr>
	</table>
</div>


<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_POST["loggedin"]) && $_POST["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>