<?php
ob_start();

session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "project22";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST['username'])){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$_SESSION['username'] = $username;
	$expire = time() + (60*5);
	setcookie("username",$username,$expire);
}
?>



<?php

if(isset($_POST['username'])){
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	//$password = $_POST['password'];
} else {
	header("Location: login.php");
} ?>

<?php   
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "project22";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(mysqli_connect_error()) {
	die("Database connection failed" . mysqli_connect_error() . "(" . mysqli_connect_errno().")"
		);
} ?>

<?php 

$query1 = "Select * FROM UserLogin WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($connection,$query1);

if(!$result) 
{
	die("Database Query Failed.");
	echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}
if(mysqli_num_rows($result) == 0) 
{
	echo $username;
	echo " <br> Unauthorized user, please try again";
	header("Location: login.php");
	exit;
	
} 
else 
{
	$query2 = "Select * FROM Student as s WHERE s.username = '$username'";
	$result2 = mysqli_query($connection,$query2);
	if(!$result2) 
	{
		die("Database Query Failed.");
		echo "Error: " . $sql . "<br>" . mysqli_error($connection);
	}
	if(mysqli_num_rows($result2) == 0) 
	{
		header("Location: home2.php");
		exit;
		ob_end_flush();
	}
	else
	{
		header("Location: home.php");
		exit;
		ob_end_flush();
	}
} 

?>

