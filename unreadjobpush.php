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
				<h1 class="title">New Job Pushes</h1>
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
where s.username = '" . $_SESSION['username'] ."';");
$row = $resource->fetch_assoc();
#echo $row['sid'] . "<br>";

$query = "select * from jobannouncement join (
select jid,cid,sid from jobpush
where sid = '".$row['sid']."' and pushstatus='Not Read' and cid not in
(select cid from jobpush where sid='".$row['sid']."' and pushstatus='Read')) as T
on jobannouncement.jid=T.jid;";

$result = mysqli_query($connection, $query);

if(!$result) 
{
	die("Database query failed.");
}
elseif(mysqli_num_rows($result) == 0)
{
	echo "<br> You have no new job pushes. ";
}
else
{
	echo "<br> Your new job pushes are: " . "<br>";
	while($row1 = mysqli_fetch_assoc($result))
	{
		echo "<br>";
		echo "Job ID       :"; echo $row1["jid"] . "<br>";
		echo "Company    :"; echo $row1["cid"] . "<br>";
		echo "Job Title :"; echo $row1["jtitle"] . "<br>";
		echo "Job Location   :"; echo $row1["jlocation"] . "<br>";
		echo "Min. Salary  :"; echo $row1["salary"] . "<br>";
		echo "Degree  :"; echo $row1["degree"] . "<br>";
		echo "Major  :"; echo $row1["major"] . "<br>";
		echo "Posted On  :"; echo $row1["postedOn"] . "<br>";
		echo "Apply before  :"; echo $row1["deadlineOn"] . "<br>";
		echo "Job Description  :"; echo $row1["description"] . "<br>"; ?>
		
		<form action="unreadjobpush1.php" method="post">
		<?php echo "<br>"; ?>
		Click here to open the job: <input type="submit" name="submit" value="Open">
		<input type="hidden" name="jid" value=<?php echo $row1["jid"] ?>>
		<input type="hidden" name="cid" value=<?php echo $row1["cid"] ?>>
		<input type="hidden" name="sid" value=<?php echo $row1["sid"] ?>>
		</form>
		
		
<?php
	}
	mysqli_free_result($result);
}	
?>	
				</div>
			</div>
		</div>
	</div>
</div>
<div class="login-register">
    <a href="home.php" >Back</a>
</div>
</body>
</html>