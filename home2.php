<?php
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
	$_SESSION['username'] = $username;
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
				
				<hr/>
			</div>
		</div>
		<div class="main-login main-center">
			
			<a href="jobannouncement.php" >
			<form class="form-horizontal text-center" method="post" action="jobannouncement.php">
			
			<div class="panel panel-primary">
			<div class="panel-heading">
			<div class="form-group ">
			<h3><label for="name" class="cols-sm-2 label">Job Announcements</label></h3>
			<div class="cols-sm-10">
			<label for="name" class="cols-sm-2 control-label"></div>
			
			</div></div>

			</div>
			</form>
			</a>
			
		</div>
		<div class="main-login main-center">
			
			<a href="jobapplication.php" >
			<form class="form-horizontal text-center" method="post" action="jobannouncement.php">
			
			<div class="panel panel-primary">
			<div class="panel-heading">
			<div class="form-group ">
			<h3><label for="name" class="cols-sm-2 label">Job Applications</label></h3>
			<div class="cols-sm-10">
			<label for="name" class="cols-sm-2 control-label"></div>
			
			</div></div>

			</div>
			</form>
			</a>
			
		</div>
	</div>
</div>
</body>
</html>