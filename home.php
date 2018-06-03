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
<?php include("nav.php"); ?>
<div class="container">
	<div class="row ">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">Show Me</h1>
				<hr/>
			</div>
		</div>
		<div class="main-login main-center">
			
			<a href="friend.php" >
			<form class="form-horizontal text-center" method="post" action="friend.php">
			
			<div class="panel panel-primary">
			<div class="panel-heading">
			<div class="form-group ">
			<h3><label for="name" class="cols-sm-2 label">My Friends</label></h3>
			<div class="cols-sm-10">
			<label for="name" class="cols-sm-2 control-label"></div>
			
			</div></div>

			</div>
			</form>
			</a>
			
		</div>
		<div class="main-login main-center">
			<a href="message.php" >
				<form class="form-horizontal text-center" method="post" action="message.php">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group ">
								<h3><label for="name" class="cols-sm-2 label">My Messages</label></h3>
									<div class="cols-sm-10">
										<label for="name" class="cols-sm-2 control-label">
									</div>
							</div>
						</div>
					</div>
				</form>
			</a>
		</div>
		<div class="main-login main-center">
			<a href="jobsearch.php" >
				<form class="form-horizontal text-center" method="post" action="jobsearch.php">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group ">
								<h3><label for="name" class="cols-sm-2 label">Job Search</label></h3>
									<div class="cols-sm-10">
										<label for="name" class="cols-sm-2 control-label">
									</div>
							</div>
						</div>
					</div>
				</form>
			</a>
		</div>
		<div class="main-login main-center">
			<a href="companysearch.php" >
				<form class="form-horizontal text-center" method="post" action="companysearch.php">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group ">
								<h3><label for="name" class="cols-sm-2 label">Company Search</label></h3>
									<div class="cols-sm-10">
										<label for="name" class="cols-sm-2 control-label">
									</div>
							</div>
						</div>
					</div>
				</form>
			</a>
		</div>
		<div class="main-login main-center">
			<a href="friendsearch.php" >
				<form class="form-horizontal text-center" method="post" action="friendsearch.php">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group ">
								<h3><label for="name" class="cols-sm-2 label">Friend Search</label></h3>
									<div class="cols-sm-10">
										<label for="name" class="cols-sm-2 control-label">
									</div>
							</div>
						</div>
					</div>
				</form>
			</a>
		</div>
	</div>
</div>
</body>
</html>