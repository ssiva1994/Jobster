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
foreach($_GET as $key=>$value){
	if(!empty($value) && isset($value)) {
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
				<h1 class="title">Job Forward</h1>
<?php

foreach($_GET as $key=>$value)
{
	if(!empty($value) && isset($value)) 
	{
		$test = urldecode($value);
		
		$query ="select s.sid,s.sfname, s.slname
		from student as s
		join
		(select sc.sid,sc.fid
		from studentconnection as sc join student as s on s.sid = sc.sid
		where s.smail = '" . $_SESSION['username'] ."'
		union all
		select sc.fid,sc.sid
		from studentconnection as sc join student as s on s.sid = sc.fid
		where s.smail = '" . $_SESSION['username'] ."') as T on T.fid = s.sid
		group by s.sid,s.sfname, s.slname;";
		
		$result = mysqli_query($connection, $query);
		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> Your friend list is empty. ";
		}
		else
		{
			echo "<br> Your friends are: " . "<br>";
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<br>";
				echo $row["sfname"]; echo " "; echo $row["slname"]; ?>
				<form action="forward1.php" method="post">
				Click here to forward    : <input type="submit" name="submit" value="Forward"> <br>
				<input type="hidden" name="fid" value=<?php echo $row["sid"] ?>> <br>
				<input type="hidden" name="jid" value=<?php echo "$test";?>> <br>
				</form>
				
				
	<?php	}
			mysqli_free_result($result);
		}  ?>
		<form action="jobsearch.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to job search page: <input type="submit" name="submit" value="Back">
		</form>


<?php }
}
?>
<hr/>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>


