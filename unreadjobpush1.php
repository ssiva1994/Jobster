<?php
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
} else {
	header("Location: login.php");
	exit;
}
?>
<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "project22";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(mysqli_connect_error()) {
	die("Database connection failed" . mysqli_connect_error() . "(" . mysqli_connect_errno().")"
		);
}
?>
<?php
$sid = mysqli_real_escape_string($connection, $_POST['sid']);
$cid = mysqli_real_escape_string($connection, $_POST['cid']);
$jid = mysqli_real_escape_string($connection, $_POST['jid']);
?>

<html>
<head>
	<link rel="stylesheet" href="bt3/css/bootstrap.css">
  <link rel="stylesheet" href="bt3/css/register_css.css">
</head>
<title>Index</title>
<body>
<?php include("nav.php"); ?>
<?php

		$query1 = "INSERT INTO JobPush (jid,cid,sid,pushDate,pushstatus) VALUES ('$jid','$cid','$sid',now(),'Read') ";
		$result1 = mysqli_query($connection, $query1);
		
		if($result1) 
		{
			echo "Job push read. . <br>";
			echo "$jid";
			
?>
			<form action="apply.php" method="get">
			<?php echo "<br>"; ?>
			Click here to apply for this job: <input type="submit" name="jobid" value=<?php echo rawurlencode($jid); ?>>
			</form>
			<form action="home.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to home page: <input type="submit" name="submit" value="Back">
			</form>
<?php
		}
		else
		{
			echo "Error: "  . "<br>" . mysqli_error($connection);
?>
			<form action="home.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to home page: <input type="submit" name="submit" value="Back">
			</form>
<?php
		}
	
?>
		
</body>
</html>