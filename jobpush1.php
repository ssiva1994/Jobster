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
$university = mysqli_real_escape_string($connection, $_POST['university']);
$major = mysqli_real_escape_string($connection, $_POST['major']);
$gpa = mysqli_real_escape_string($connection, $_POST['gpa']);
$keyword = mysqli_real_escape_string($connection, $_POST['keyword']);
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
<div class="container">
	<div class="panel-heading">
	<?php
		if(empty($university) and empty($major) and empty($gpa) and empty($keyword))
		{
	?>
		<form action="jobannouncement.php" method="post">
		Search Keyword cannot be empty. <br>
		Click here the return to previous page: <input type="submit" name="submit" value="Back">
		</form>
	</div>
</div>	
		<?php 
		} 
		else
		{
			$query = "select * from student as s
			where s.university like '%" . $university . "%' and s.major like '%" . $major . "%' and s.gpa > '$gpa' and s.resume like '%" . $keyword . "%'";
			$result = mysqli_query($connection, $query);
			if(!$result) 
			{
				die("Database query failed.");
		?>
			<form action="jobannouncement.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to previous page: <input type="submit" name="submit" value="Back">
			</form>
		
		<?php
			}
			if(mysqli_num_rows($result) == 0)
			{ 
				echo "<br> Sorry there are no matching students available.";
			}
			 ?>
			
			<?php
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "Student ID       :"; echo $row["sid"] . "<br>";
				echo "Student Name :"; echo $row["sfname"]; echo " "; echo $row["slname"] . "<br>";
				echo "Degree and Major :"; echo $row["degree"]; echo " in "; echo $row["major"] . "<br>";
				echo "University  :"; echo $row["university"] . "<br>";?>
			<form action="jobpush2.php" method="post">
				Click here to push the job to this student: <input type="submit" name="sid" value="Push"> <br>
				<input type="hidden" name="jid" value=<?php echo "$jid" ?>>
				<input type="hidden" name="sid" value=<?php echo $row["sid"] ?>>
			</form>
	<?php	}  ?>
		<form action="jobannouncement.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to previous page: <input type="submit" name="submit" value="Back">
		</form>
		
	<?php
		}
		?>
		
		

</body>
</html>