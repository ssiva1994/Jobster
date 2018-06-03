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


$query ="select * from jobpush as j
		where j.sid='$sid' and j.jid='$jid' and j.cid='$cid';";
		
$result = mysqli_query($connection, $query);
		if(!$result) 
		{
			die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) > 0)
		{
			echo "<br> You already pushed this job to this student. ";
		}
		else
		{
			$query1 = "INSERT INTO JobPush (jid,cid,sid,pushDate,pushstatus) VALUES ('$jid', '$cid', '$sid', now(), 'Not Read');";
			$result1 = mysqli_query($connection, $query1);
			if($result1) 
			{
				echo "The job announcement has been pushed to the student. . <br>";
				?>
				<form action="jobannouncement.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to job search page: <input type="submit" name="submit" value="Back">
				</form>
		<?php
			}
			else
			{
				echo "Error: "  . "<br>" . mysqli_error($connection);
				?>
				<form action="jobannouncement.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to job search page: <input type="submit" name="submit" value="Back">
				</form>
		<?php
			}		
		}
			mysqli_free_result($result);
		?>
		
</body>
</html>