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

$query ="select * from student where sid='$fid';";
$result = mysqli_query($connection, $query);


		if(!$result) 
		{
			die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> User doesn't exist. "; ?>
			<form action="home.php" method="post">	
			Click here to go back to home page: <input type="submit" name="submit" value="Click"> <br>
			</form>

		<?php
		}
		else
		{

				echo "<br> Profile: " . "<br>";
				while($row = mysqli_fetch_assoc($result))
				{
					echo "<br>";
					echo "Student ID       :"; echo $row["sid"] . "<br>";
					echo "Student Name :"; echo $row["sfname"]; echo " "; echo $row["slname"] . "<br>";
					echo "Student Location :"; echo $row["scity"]; echo ","; echo $row["sstate"] . "<br>";
					echo "Email ID    :"; echo $row["smail"] . "<br>";
					echo "Phone Number  :"; echo $row["sphone"] . "<br>";
					echo "Degree and Major :"; echo $row["degree"]; echo " in "; echo $row["major"] . "<br>";
					echo "Status  :"; echo $row["status"] . "<br>";
					echo "GPA  :"; echo $row["gpa"] . "<br>";
					echo "Interest  :"; echo $row["interest"] . "<br>";
					echo "Resume  :"; echo $row["resume"] . "<br>";
				}	
	
			mysqli_free_result($result); ?>
			
			<form action="friend.php" method="post">	
			Click here to go back to previous page: <input type="submit" name="submit" value="Click"> <br>
			</form>
		<?php
		}
		
		?>			
</body>
</html>