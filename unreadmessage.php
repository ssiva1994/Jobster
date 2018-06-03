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
$resource = $connection->query("select s.sid
from student as s
where s.username = '" . $_SESSION['username'] ."';");
$row = $resource->fetch_assoc();
#echo $row['sid'] . "<br>";

$query = "select * from message as m 
where m.fid = '".$row['sid']."' and m.messagestatus = 'Not Read' 
and m.sid not in (select m1.sid from message as m1 where m1.messagestatus = 'Read');";
$result = mysqli_query($connection, $query);

if(!$result) 
{
	die("Database query failed.");
}
elseif(mysqli_num_rows($result) == 0)
{
	echo "<br> You have no new messages. ";
}
else
{
	echo "<br> Your new messages are: " . "<br>";
	while($row1 = mysqli_fetch_assoc($result))
	{
		echo "<br>";
		echo "From       :"; echo $row1["sid"] . "<br>";
		#echo "Message    :"; echo $row1["message"] . "<br>";
		echo "Sent at    :"; echo $row1["sendDate"] . "<br>"; ?>
		
		<form action="unreadmessage1.php" method="get">
		<?php echo "<br>"; ?>
		Click here to read the message: <input type="submit" name="submit" value=<?php echo rawurlencode($row1['sid']); ?>>
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