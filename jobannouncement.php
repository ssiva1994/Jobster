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
<?php include("nav2.php"); ?>
<div class="container">
	<div class="row ">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">Jobs</h1>
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
			$resource = $connection->query("select c.cid
			from Company as c
			where c.cmail = '" . $_SESSION['username'] ."';");
			$answer = $resource->fetch_assoc();
			$cid = $answer['cid'];
			
			$resource1 = $connection->query("select c.cname
			from Company as c
			where c.cmail = '" . $_SESSION['username'] ."';");
			$answer1 = $resource1->fetch_assoc();
			$cname = $answer1['cname'];
			
		
		$query ="select * from jobannouncement as ja
		where ja.cid = '$cid';";

$result = mysqli_query($connection, $query);


		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> Your job list is empty. ";
		}
		else
		{
			echo "<br> Your job announcements are: " . "<br>";
			while($row2 = mysqli_fetch_assoc($result))
			{
				echo "<br>";
				echo "Job ID       :"; echo $row2["jid"] . "<br>";
				echo "Company    :"; echo "$cname" . "<br>";
				echo "Job Title :"; echo $row2["jtitle"] . "<br>";
				echo "Job Location   :"; echo $row2["jlocation"] . "<br>";
				echo "Min. Salary  :"; echo $row2["salary"] . "<br>";
				echo "Degree  :"; echo $row2["degree"] . "<br>";
				echo "Major  :"; echo $row2["major"] . "<br>";
				echo "Posted On  :"; echo $row2["postedOn"] . "<br>";
				echo "Apply before  :"; echo $row2["deadlineOn"] . "<br>";
				echo "Job Description  :"; echo $row2["description"] . "<br>";
				?>
				<form action="jobpush.php" method="post">
				Click here to push this job: <input type="submit" name="jobid" value="Push"> <br>
				<input type="hidden" name="jid" value=<?php echo $row2["jid"] ?>>
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
<div class="container">
	<div class="panel-heading">
		<div class="panel-title text-center">
			<form action="jobannouncement1.php" method="post">
			Click here to post a new job announcement: <input type="submit" name="submit" value="Post">
			</form>
		</div>
	</div>
</div>
<div class="login-register">
    <a href="home2.php" >Back</a>
</div>
</body>
</html>