<?php
	//load libraries
	require("config.lib.php");
	require("database.lib.php");
	
	$dbConnection = databaseConnect(); // Connect to the database
?>

<htmL>
<style>
body {background-color: #f7f8fc;}

h2 {
    color: white;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
  }

  h3 {
    color: white;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
  }

input[type=text] {
    width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  font-family: Arial, Helvetica, sans-serif;
  border-radius: 4px;
}
input[type=submit] {
    background-color: #f07120;
  color: white;
  font-weight : bold;
  font-size : 16px;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 4px;
}

input[type=submit]:hover {
  opacity: 0.8;
}

img.avatar {
  width: 50%;
}

.content {
  max-width: 400;
  margin: auto;
  margin-top: 80px;
  border-radius: 5px;
  background-color: #1A2364;
  padding: 20px;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

.message{
  width: 420;
  margin: auto;
  margin-top: 10px;
  border-radius: 5px;
  background-color: #1FB062;
  padding: 10px;
}

</style>

<head>
	<title>Login</title>
</head>

<body>
    <form id="login" action="" method="post">
        <div class="content">
            <div class="imgcontainer">
                <img src="UIC.png" alt="Avatar" class="avatar">
            </div>
		    <input type="text" name="email" placeholder="Email address" id="email" required>
		    <input type="text" name="password" placeholder="Password" id="password" required>
            <input type="submit" name="login" value="Log in"> 
        </div>
</form>

<?php
$message="";

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

        if(mysqli_num_rows($result_set) == 1 ){
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            header("location: welcome.php", TRUE, 301);
            exit();
        } else {
          ?>
          <div class="message">
          <h3>Username and&#47;or password incorrect, try again.</h3>
          </div>
          <?php
        }
    }
}
databaseDisconnect($dbConnection); // disconnect from database
?>	
</body>
</html>