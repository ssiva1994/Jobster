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
foreach($_GET as $key=>$id){
	if(!empty($id) && isset($id)) {
    #echo urldecode($key), ' => ', $value, "<br/>"; 
	}
} 
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
				<h1 class="title">New Messages</h1>
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
foreach($_GET as $key=>$id)
{
	if(!empty($id) && isset($id)) 
	{
	$sid = urldecode($id);
	echo "$sid";

	$resource = $connection->query("select s.sid
	from student as s
	where s.username = '" . $_SESSION['username'] ."';");
	$row = $resource->fetch_assoc();
	$fid = $row['sid'];
	echo $fid . "<br>";
	
	$resource1 = $connection->query("select s.sid
	from student as s
	where s.username = '" . $_SESSION['username'] ."';");
	$row = $resource->fetch_assoc();
	$fid = $row['sid'];

	$query = "select * from message as m 
	where m.fid = '$fid' and m.sid='$sid' and m.messagestatus = 'Not Read' 
	and m.sid not in (select m1.sid from message as m1 where m1.messagestatus = 'Read' and m1.sid='$sid');";
	$result = mysqli_query($connection, $query);

	if(!$result) 
	{
		die("Database query failed.");
	}
	elseif(mysqli_num_rows($result) == 0)
	{
		$query1="";
	}
	else
	{
		INSERT INTO `Message` VALUES ('$sid', '$fid', 'Hi! How are you?', '2014-01-31 12:12:00', 'Not Read');
	}	
	mysqli_free_result($result);
	}
	}
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