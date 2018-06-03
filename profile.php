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

$query = "select * from Student as s where s.sid ='$sid';";
$result = mysqli_query($connection, $query);
if(!$result)
	{
		die("Database query failed.");
	}
while($row = mysqli_fetch_assoc($result)) 
{
	echo "Student ID:"; echo $row["sid"] . "<br>";
	echo "Name :"; echo $row["sfname"]; echo " "; echo $row["slname"] . "<br>";
	echo "City:"; echo $row["scity"] . "<br>";
	echo "State:"; echo $row["sstate"] . "<br>";
	echo "EMail ID:"; echo $row["smail"] . "<br>";
	echo "Phone Number:"; echo $row["sphone"] . "<br>";
	echo "University:"; echo $row["university"] . "<br>";
	echo "Enrolled On:"; echo $row["enrolledon"] . "<br>";
	echo "Status:"; echo $row["status"] . "<br>";
	echo "Degree:"; echo $row["degree"] . "<br>";
	echo "Major:"; echo $row["major"] . "<br>";
	echo "GPA:"; echo $row["gpa"] . "<br>";
	echo "Interest:"; echo $row["interest"] . "<br>";
	echo "Resume:"; echo $row["resume"] . "<br>";
}
?>			

<form action="home.php" method="post">
<?php echo "<br>"; ?>
Click here to return back to job search page: <input type="submit" name="submit" value="Back">
</form>

</body>
</html>