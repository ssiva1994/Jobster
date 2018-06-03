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
$fid = mysqli_real_escape_string($connection, $_POST['fid']);
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
	$query = "select * from studentconnection as sc
	where sc.sid='$sid' and sc.fid='$fid' and sc.status='Not Read';";
	$result = mysqli_query($connection, $query);
	
	if(!$result) 
	{
		die("Database query failed.");
	}
	elseif(mysqli_num_rows($result) > 0)
	{
		echo "<br> You have already sent a friend request. ";
	?>
	<form action="home.php" method="post">
	<?php echo "<br>"; ?>
	Click here to return back to home page: <input type="submit" name="submit" value="Back">
	</form>
	
	<?php
	}
	else
	{
		$query1 = "INSERT INTO StudentConnection (sid,fid,modifiedDate,status) VALUES ('$sid','$fid',now(),'Not Read') ";
		$result1 = mysqli_query($connection, $query1);
		
		if($result1) 
		{
			echo "The friend request has been sent. . <br>";
?>
			<form action="friendsearch.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to friend search page: <input type="submit" name="submit" value="Back">
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
	}
?>
		
</body>
</html>