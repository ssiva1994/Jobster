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
	<div class="panel-heading">
	<?php
	$resource = $connection->query("select s.sid
	from student as s
	where s.smail = '" . $_SESSION['username'] ."';");
	$answer = $resource->fetch_assoc();
	$student_id = $answer['sid'];

	$query = "select * from student as s
	where s.sid != '$student_id' and s.sid not in (
	select s.sid
	from student as s
	join
	(select sc.sid,sc.fid
	from studentconnection as sc join student as s on s.sid = sc.sid
	where (s.smail = '" . $_SESSION['username'] ."') and (sc.status = 'Accepted' or sc.status='Rejected')
	union all
	select sc.fid,sc.sid
	from studentconnection as sc join student as s on s.sid = sc.fid
	where (s.smail = '" . $_SESSION['username'] ."') and (sc.status = 'Accepted' or sc.status='Rejected')) as T on T.fid = s.sid
	group by s.sid
	);";
	$result = mysqli_query($connection, $query);
	if(mysqli_num_rows($result) == 0)
	{ 
		echo "<br> Sorry there are students available.";
	}
	if(!$result) 
	{
		die("Database query failed.");
	} 
	while($row = mysqli_fetch_assoc($result)) 
	{
		echo "Student ID       :"; echo $row["sid"] . "<br>";
		echo "Student Name :"; echo $row["sfname"]; echo " "; echo $row["slname"] . "<br>";
		echo "Degree and Major :"; echo $row["degree"]; echo " in "; echo $row["major"] . "<br>";
		echo "University  :"; echo $row["university"] . "<br>"; ?>
		<form action="friendsearch1.php" method="post">		
		Click here to send a friend request: <input type="submit" name="studentid" value="Request"> <br>
		<input type="hidden" name="fid" value=<?php echo $row["sid"] ?>>
		<input type="hidden" name="sid" value=<?php echo "$student_id" ?>>
		</form>
	<?php	
	}
		
	?>
	<form action="home.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to home page: <input type="submit" name="submit" value="Back">
	</form>
		
	</div>
</div>
</body>
</html>