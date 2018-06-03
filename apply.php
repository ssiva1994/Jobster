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
				<h1 class="title">Job Search</h1>
<?php
foreach($_GET as $key=>$value)
{
	if(!empty($value) && isset($value)) 
	{
		$test = urldecode($value);
		
		$resource = $connection->query("select s.sid
		from student as s
		where s.smail = '" . $_SESSION['username'] ."';");
		$answer = $resource->fetch_assoc();
		#echo $answer['sid'] . "<br>";
		$query = "select * from Application as A where A.sid = '".$answer['sid']."' and A.jid = '$test' and A.appstatus = 'Not Read' ;";
		$result = mysqli_query($connection, $query);
		
		if(!$result) 
		{
			die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			$student_id = $answer['sid'];
			$job_id = "$test";
			#echo "$answer['sid'] .";
			#echo "$job_id";
			
			$query1 = "INSERT INTO Application (sid,jid,appliedDate,appstatus) VALUES ('$student_id', '$job_id', now(), 'Not Read');";
			$result1 = mysqli_query($connection, $query1);
			if($result1) 
			{
				$query2 = "select * from Application as A where A.sid = '".$answer['sid']."' and A.appstatus = 'Not Read' ;" ;

				$result2 = mysqli_query($connection, $query2);
				if(!$result2)
				{
					die("Database query failed.");
				} 
				elseif(mysqli_num_rows($result2) == 0) 
				{
					echo "<br> Sorry there are no job applications. ";
				}
				else
				{
					echo "<br> You applications are: " . "<br>";
					while($row = mysqli_fetch_assoc($result2)) 
					{
						echo "<br>";
						echo "JobID    :";echo $row["jid"] . "<br>";
						echo "Applied On    :";echo $row["appliedDate"] . "<br>";
		
					}
					mysqli_free_result($result2);
				}
			}
			else
			{
				echo "Error: "  . "<br>" . mysqli_error($connection);
			}		
			
		}
		else
		{
			echo "<br> You have already applied to this job on ";
			while($row = mysqli_fetch_assoc($result))
			{
				echo $row["appliedDate"] . "<br>";
				
			}
			$query = "select * from Application as A where A.sid = '".$answer['sid']."' and A.jid = '$test' and A.appstatus = 'Not Read' ;" ;

			$result = mysqli_query($connection, $query);
			if(!$result)
			{
				die("Database query failed.");
			} 
			elseif(mysqli_num_rows($result) == 0) 
			{
				echo "<br> Sorry there are no books currently checked out. ";
			}
			else
			{
				echo "<br> Thank you for applying for this job" . "<br>";
				echo "<br> You applications are: " . "<br>";
				while($row = mysqli_fetch_assoc($result)) 
				{
					echo "<br>";
					echo "JobID    :";echo $row["jid"] . "<br>";
					echo "Applied On    :";echo $row["appliedDate"] . "<br>";
		
				}
				mysqli_free_result($result);
			}
			#mysqli_free_result($result);
		}
		?>
		
		<form action="jobsearch.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to home page: <input type="submit" name="submit" value="Back">
		</form>
<?php
	}
}
?>
<hr/>
			</div>
		</div>
		
	</div>
</div>
</body>
</html>