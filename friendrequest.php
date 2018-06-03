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
<div class="container">
	<div class="row ">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">New Friend Requests</h1>
				<hr/>
			</div>
		</div>
		
	</div>
</div>
<div class="main-login main-center">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="form-group ">
				<div class="cols-sm-10">
					<label for="name" class="cols-sm-2 control-label">
<?php
$resource = $connection->query("select s.sid
from student as s
where s.smail = '" . $_SESSION['username'] ."';");
$answer = $resource->fetch_assoc();
$student_id = $answer['sid'];

$query ="select sid, sfname, slname from student
where sid in (
select sid from studentconnection
where fid='$student_id' and status='Not Read' and sid not in (
select sid from studentconnection
where fid='$student_id' and status='Read'));";

$result = mysqli_query($connection, $query);
		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> There are no new friend requests. ";
		?>
		<form action="home.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to home page: <input type="submit" name="submit" value="Back">
		</form>
		<?php
		}
		else
		{
			echo "<br> Your new friend requests are: " . "<br>";
			?>
			<form action="friendrequest1.php" method="post">
			<?php
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<br>";
				echo $row["sfname"]; echo " "; echo $row["slname"]; echo "<br>";
			?>
			Click here to accept this friend request: <input type="submit" name="req" value="Accept"> <br>
			Click here to reject this friend request: <input type="submit" name="req" value="Reject"> <br>
				<input type="hidden" name="fid" value=<?php echo "$student_id" ?>>
				<input type="hidden" name="sid" value=<?php echo $row["sid"] ?>>
			</form>
	<?php	}
		
			mysqli_free_result($result);
		?>
			<form action="home.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to home page: <input type="submit" name="submit" value="Back">
			</form>
		<?php
		}
		
		?>	
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>