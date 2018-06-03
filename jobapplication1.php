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
$jid = mysqli_real_escape_string($connection, $_POST['jid']);
$resume = mysqli_real_escape_string($connection, $_POST['resume']);
$decision = mysqli_real_escape_string($connection, $_POST['req']);
?>

<html>
<head>
	<link rel="stylesheet" href="bt3/css/bootstrap.css">
  <link rel="stylesheet" href="bt3/css/register_css.css">
</head>
<title>Index</title>
<body>
<?php include("nav2.php"); ?>
<?php

$resource = $connection->query("select c.cid
			from Company as c
			where c.cmail = '" . $_SESSION['username'] ."';");
			$answer = $resource->fetch_assoc();
			$cid = $answer['cid'];

if($decision = 'Accept')
{
			$query1 = "INSERT INTO Application (sid,jid,appliedDate,appstatus) VALUES ('$sid', '$jid', now(), 'Read');";
			$result1 = mysqli_query($connection, $query1);
			$query2 = "INSERT INTO Application (sid,jid,appliedDate,appstatus) VALUES ('$sid', '$jid', now()+1, 'Accepted');";
			$result2 = mysqli_query($connection, $query2);
			if($result1 or $result2) 
			{
				echo "The job application has been accepted. . <br>";
				?>
				<form action="jobapplication.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to job application page: <input type="submit" name="submit" value="Back">
				</form>
		<?php
			}
			else
			{
				echo "Error: "  . "<br>" . mysqli_error($connection);
				?>
				<form action="home2.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to home page: <input type="submit" name="submit" value="Back">
				</form>
		<?php
			}		
}		
else
{
			$query1 = "INSERT INTO Application (sid,jid,appliedDate,appstatus) VALUES ('$sid', '$jid', now(), 'Read');";
			$result1 = mysqli_query($connection, $query1);
			$query2 = "INSERT INTO Application (sid,jid,appliedDate,appstatus) VALUES ('$sid', '$jid', now(), 'Rejected');";
			$result2 = mysqli_query($connection, $query2);
			if($result1 or $result2) 
			{
				echo "The job application has been accepted. . <br>";
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