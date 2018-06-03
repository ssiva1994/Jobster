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
$fid = mysqli_real_escape_string($connection, $_POST['fid']);
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
	$resource = $connection->query("select s.sid
	from student as s
	where s.smail = '" . $_SESSION['username'] ."';");
	$answer = $resource->fetch_assoc();
	$sid = $answer['sid'];
	
	$query = "select * from JobForward as J
	where J.sid='$sid' and J.fid='$fid' and J.jid='$jid' and j.forwardstatus='Not Read';";
	$result = mysqli_query($connection, $query);
	
	if(!$result) 
	{
		die("Database query failed.");
	}
	elseif(mysqli_num_rows($result) > 0)
	{
		echo "<br> You have already forwarded this job to this friend.";
	?>
	<form action="jobsearch.php" method="post">
	<?php echo "<br>"; ?>
	Click here to return back to job search page: <input type="submit" name="submit" value="Back">
	</form>
	
	<?php
	}
	else
	{
		$query1 = "INSERT INTO JobForward (sid,fid,jid,forwardDate,forwardstatus) VALUES ('$sid','$fid','$jid',now(),'Not Read') ";
		$result1 = mysqli_query($connection, $query1);
		
		if($result1) 
		{
			echo "The job has been forwarded successfully. . <br>";
?>
			<form action="jobsearch.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to job search page: <input type="submit" name="submit" value="Back">
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