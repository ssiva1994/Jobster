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
				<h1 class="title">New Job applications</h1>
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
$row = $resource->fetch_assoc();
$cid = $row['cid'];

$query ="select sfname,slname,resume,T.sid,T.jid,T.appliedDate,T.appstatus from student join (
select sid,jid,appliedDate,appstatus from application
where appstatus = 'Not Read' and jid IN (select jid from jobannouncement where cid = '$cid') and sid not in
(select sid from application
where appstatus = 'Read' and jid IN (select jid from jobannouncement where cid = '$cid'))
) as T on student.sid = T.sid;";

$result = mysqli_query($connection, $query);


		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> application list is empty. ";
		}
		else
		{
			echo "<br> New job applications are: " . "<br>";
			while($row2 = mysqli_fetch_assoc($result))
			{
				echo "<br>";
				echo "Job ID       :"; echo $row2["jid"] . "<br>";
				echo "Student ID    :"; echo $row2["sid"] . "<br>";
				echo "Student Name :"; echo $row2["sfname"]; echo " "; echo $row2["slname"] . "<br>";
				echo "Resume   :"; echo $row2["resume"] . "<br>";
				echo "Applied On   :"; echo $row2["appliedDate"] . "<br>";
				echo "Status  :"; echo $row2["appstatus"] . "<br>";
				?>
				<form action="jobapplication1.php" method="post">
				Click here to accept this application: <input type="submit" name="req" value="Accept"> <br>
				Click here to reject this application: <input type="submit" name="req" value="Reject"> <br>
				<input type="hidden" name="jid" value=<?php echo $row2["jid"] ?>>
				<input type="hidden" name="sid" value=<?php echo $row2["sid"] ?>>
				<input type="hidden" name="resume" value=<?php echo $row2["resume"] ?>>
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
	<div class="row ">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">Old job applications</h1>
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
$query ="select sfname,slname,resume,T.sid,T.jid,T.appliedDate,T.appstatus from student join (
select sid,jid,appliedDate,appstatus from application
where (appstatus = 'Accepted' or appstatus='Rejected') and jid IN (select jid from jobannouncement where cid = '$cid')
) as T on student.sid=T.sid;";

$result = mysqli_query($connection, $query);


		if(!$result) 
		{
		die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			echo "<br> application list is empty. ";
		}
		else
		{
			echo "<br> Old job applications are: " . "<br>";
			while($row2 = mysqli_fetch_assoc($result))
			{
				echo "<br>";
				echo "Job ID       :"; echo $row2["jid"] . "<br>";
				echo "Student ID    :"; echo $row2["sid"] . "<br>";
				echo "Student Name :"; echo $row2["sfname"]; echo " "; echo $row2["slname"] . "<br>";
				echo "Resume   :"; echo $row2["resume"] . "<br>";
				echo "Applied On   :"; echo $row2["appliedDate"] . "<br>";
				echo "Status  :"; echo $row2["appstatus"] . "<br>";
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
    <a href="home2.php" >Back</a>
</div>
</body>
</html>