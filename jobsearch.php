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
				<h1 class="title">Job Search</h1>
				<form action="jobsearch1.php" method="post">
				Job Title    : <input type="text" name="jobtitle" value=""> <br>
				Location     : <input type="text" name="location" value=""> <br>
				Description  : <input type="text" name="description" value=""> <br>
				<input type="submit" name="submit" value="submit">
				</form>
				<form action="home.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to home page: <input type="submit" name="submit" value="Back">
				</form>
				<hr/>
			</div>
		</div>
		
	</div>
</div>
<div class="container">
	<div class="row ">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">Applications</h1>
<?php
				
$resource = $connection->query("select s.sid
from Student as s
where s.smail = '" . $_SESSION['username'] ."';");
$row = $resource->fetch_assoc();
$sid = $row['sid'];

$query ="select * from jobannouncement where jid in (
select distinct jid from application where sid='$sid' group by jid);";

$result = mysqli_query($connection, $query);


		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> application list is empty. ";
		}
		else
		{
			echo "<br> Your applications are: " . "<br>";
			while($row2 = mysqli_fetch_assoc($result))
			{
				echo "Job ID       :"; echo $row2["jid"] . "<br>";
				echo "Company    :"; echo $row2["cid"] . "<br>";
				echo "Job Title :"; echo $row2["jtitle"] . "<br>";
				echo "Job Location   :"; echo $row2["jlocation"] . "<br>";
				echo "Min. Salary  :"; echo $row2["salary"] . "<br>";
				echo "Degree  :"; echo $row2["degree"] . "<br>";
				echo "Major  :"; echo $row2["major"] . "<br>";
				echo "Posted On  :"; echo $row2["postedOn"] . "<br>";
				echo "Apply before  :"; echo $row2["deadlineOn"] . "<br>";
				echo "Job Description  :"; echo $row2["description"] . "<br>";
			}
			mysqli_free_result($result);
		}
		
		?>	
				<form action="home.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to home page: <input type="submit" name="submit" value="Back">
				</form>
				<hr/>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>