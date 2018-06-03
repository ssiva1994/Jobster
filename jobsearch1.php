<?php
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
} else {
	header("Location: login.php");
	exit;
}
$jobtitle = $_POST['jobtitle'];
$location = $_POST['location'];
$description = $_POST['description'];
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
		if(empty($jobtitle) and empty($location) and empty($description)){ ?>
		<form action="jobsearch.php" method="post">
		Search Keyword cannot be empty. <br>
		Click here the return to search page: <input type="submit" name="submit" value="Back">
		</form>
	</div>
</div>	
		<?php } 
		else
		{
			$query = "select * from JobAnnouncement as j
			where j.jtitle like '%" . $jobtitle . "%' and j.jlocation like '%" . $location . "%' and j.description like '%" . $description . "%';";
			$result = mysqli_query($connection, $query);
			if(mysqli_num_rows($result) == 0)
			{ 
				echo "<br> Sorry there are no matching job announcements.";
			}
			if(!$result) 
			{
				die("Database query failed.");
			} 
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "Job ID       :"; echo $row["jid"] . "<br>";
				echo "Company    :"; echo $row["cid"] . "<br>";
				echo "Job Title :"; echo $row["jtitle"] . "<br>";
				echo "Job Location   :"; echo $row["jlocation"] . "<br>";
				echo "Min. Salary  :"; echo $row["salary"] . "<br>";
				echo "Degree  :"; echo $row["degree"] . "<br>";
				echo "Major  :"; echo $row["major"] . "<br>";
				echo "Posted On  :"; echo $row["postedOn"] . "<br>";
				echo "Apply before  :"; echo $row["deadlineOn"] . "<br>";
				echo "Job Description  :"; echo $row["description"] . "<br>"; ?>
			<form action="apply.php" method="get">	
				Click here to apply for this job: <input type="submit" name="jobid" value=<?php echo rawurlencode($row['jid']); ?>> <br>
				
			</form>
			<form action="forward.php" method="get">
				Click here to forward this job: <input type="submit" name="jobid" value=<?php echo rawurlencode($row['jid']); ?>> <br>
			</form>
	<?php	}
		}
		?>
		<form action="jobsearch.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to job search page: <input type="submit" name="submit" value="Back">
		</form>
		

</body>
</html>