<?php
include 'functions.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-color: #eeeff5;
}

.topnav {
  overflow: hidden;
  background-color: #1A2364;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a.rightSideMenu{
   float:right;
}

.topnav a:hover {
  background-color: #1FB062;
  color: white;
}

.topnav a.active {
  background-color: #f07120;
  color: white;
}

.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: #f07120 ;
   color: white;
   text-align: center;
}

.footer p{
   margin: 7.5px;
}

.tableTopFive{
  position: relative;
  top: 30px;
  border-radius: 5px;
  width:400px;
  height:300px;
  background-color: #ffffff;

}

</style>
</head>
<body>

<div class="topnav">
   <img src="UIC2.png"> <!--button van maken die naar home page gaat-->
   <a class="rightSideMenu" href = "logout.php">Sign Out</a>
</div>

<div class="tableTopFive">
    <?php arrayToTopFive() ?>
</div>

<div class="map">
    <?php  ?>
</div>



<div class="footer"> 
<p><small>&copy; Copyright 2021, Storm Metrics Company. All Rights Reserved.</small></p>
</div>


</body>
</html>