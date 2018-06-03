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
$decision = mysqli_real_escape_string($connection, $_POST['req']);
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
if($decision = 'Accept')
{
			$query1 = "INSERT INTO StudentConnection (sid,fid,modifiedDate,status) VALUES ('$sid', '$fid', now(), 'Read');";
			$result1 = mysqli_query($connection, $query1);
			$query2 = "INSERT INTO StudentConnection (sid,fid,modifiedDate,status) VALUES ('$sid', '$fid', now()+1, 'Accepted');";
			$result2 = mysqli_query($connection, $query2);
			if($result1 or $result2) 
			{
				echo "The friend request has been accepted. . <br>";
				?>
				<form action="friendrequest.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to friend request page: <input type="submit" name="submit" value="Back">
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
else
{
			$query1 = "INSERT INTO StudentConnection (sid,fid,modifiedDate,status) VALUES ('$sid', '$fid', now(), 'Read');";
			$result1 = mysqli_query($connection, $query1);
			$query2 = "INSERT INTO StudentConnection (sid,fid,modifiedDate,status) VALUES ('$sid', '$fid', now()+1, 'Rejected');";
			$result2 = mysqli_query($connection, $query2);
			if($result1 or $result2) 
			{
				echo "The friend request has been rejected. . <br>";
				?>
				<form action="friendrequest.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to friend request page: <input type="submit" name="submit" value="Back">
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