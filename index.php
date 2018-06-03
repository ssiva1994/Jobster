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
</head>
<title>Index</title>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php"><i class="glyphicon glyphicon-home"> </i> Jobster</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
  </div>
</nav>

<script src ="bt3/js/jquery-3.2.1.min.js"></script>
<script src ="bt3/js/bootstrap.js"></script>

</body>

</html>
