<?php
session_start();
if ( isset($_COOKIE['username']) && ($_COOKIE['username'] == $_SESSION["username"]) )
{
	setcookie("username",'',time()-42000);
	#OR setcookie("username",$_COOKIE['username'];,time()+60*5);
} 
if (isset($_SESSION["username"])) 
{
	$_SESSION["username"] =  null;
	session_destroy();
	header("Location: login.php");
} else {
	#header("Location: login.php");
	echo "Error Unauthorized access <br>";
	echo "<a href='login.php'> Try logging in again. </a>";
}


