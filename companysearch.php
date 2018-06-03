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
				<h1 class="title">Company Search</h1>
				<form action="companysearch1.php" method="post">
				Company Name    : <input type="text" name="companyname" value=""> <br>
				<input type="submit" name="submit" value="submit">
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
				<h1 class="title">The companies you follow are:</h1>
<?php
$resource = $connection->query("select s.sid
from student as s
where s.smail = '" . $_SESSION['username'] ."';");
$answer = $resource->fetch_assoc();
$sid = $answer['sid'];

$query = "select T.sid,T.cid,cname,T.connectedDate from company join
(select sid,cid,connectedDate from companyconnection where sid='$sid') 
as T on company.cid=T.cid;";
$result = mysqli_query($connection, $query);


		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> You do not follow any company. ";
		}
		else
		{
			echo "<br> The companies you follow are: " . "<br>";
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<br>";
				echo "Company ID       :"; echo $row["cid"] . "<br>";
				echo "Company Name :"; echo $row["cname"] . "<br>";
				echo "Followed On   :"; echo $row["connectedDate"] . "<br>";
				?>
				<form action="unfollow.php" method="post">
				<?php echo "<br>"; ?>
				Click here to unfollow: <input type="submit" name="submit" value="Unfollow">
				<input type="hidden" name="cid" value=<?php echo $row["cid"] ?>>
				<input type="hidden" name="sid" value=<?php echo "$sid" ?>>
				</form>
				
				
			<?php
			}
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