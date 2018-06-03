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
				<h1 class="title">Job Push</h1>
<?php
$jid = mysqli_real_escape_string($connection, $_POST['jid']);
?>
				<form action="jobpush1.php" method="post">
					University    : <input type="text" name="university" value=""> <br>
					Major     : <input type="text" name="major" value=""> <br>
					GPA  : <input type="text" name="gpa" value=""> <br>
					Resume Keyword  : <input type="text" name="keyword" value=""> <br>
					<input type="hidden" name="jid" value=<?php echo "$jid"; ?>>
					<input type="submit" name="submit" value="submit">
				</form>
<hr/>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>