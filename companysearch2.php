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
				<h1 class="title">Company Search</h1>
<?php
foreach($_GET as $key=>$value)
{
	if(!empty($value) && isset($value)) 
	{
		$cid = urldecode($value);
		
		$resource = $connection->query("select s.sid
		from student as s
		where s.smail = '" . $_SESSION['username'] ."';");
		$answer = $resource->fetch_assoc();
		#echo $answer['sid'] . "<br>";
		$sid=$answer['sid'];
		#echo "$sid";
		#echo "$cid";
		
		$query = "select * from CompanyConnection as cc where cc.sid = '$sid' and cc.cid = '$cid';";
		$result = mysqli_query($connection, $query);
		
		if(!$result) 
		{
			die("Database query failed.");
		}
		elseif(mysqli_num_rows($result) == 0)
		{
			$query1 = "INSERT INTO CompanyConnection (sid,cid,connectedDate) VALUES ('$sid', '$cid', now());";
			$result1 = mysqli_query($connection, $query1);
			if($result1) 
			{
				$query2 = "select c.cname from company as c
				join companyconnection as cc on c.cid=cc.cid
				where cc.sid='$sid';" ;

				$result2 = mysqli_query($connection, $query2);
				if(!$result2)
				{
					die("Database query failed.");
				} 
				elseif(mysqli_num_rows($result2) == 0) 
				{
					echo "<br> Sorry there are no books currently checked out. ";
				}
				else
				{
					echo "<br> The companies you follow are: " . "<br>";
					while($row = mysqli_fetch_assoc($result2)) 
					{
						echo "<br>";
						echo "Company Name:";echo $row["cname"] . "<br>";	
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
			echo "<br> You are already following this company ";
			

			$query3 = "select c.cname from company as c
				join companyconnection as cc on c.cid=cc.cid
				where cc.sid='$sid';" ;

				$result3 = mysqli_query($connection, $query3);
				if(!$result3)
				{
					die("Database query failed.");
				} 
				elseif(mysqli_num_rows($result3) == 0) 
				{
					echo "<br> Sorry there are no books currently checked out. ";
				}
				else
				{
					echo "<br> The companies you follow are: " . "<br>";
					while($row1 = mysqli_fetch_assoc($result3)) 
					{
						echo "<br>";
						echo "Company Name:";echo $row1["cname"] . "<br>";	
					}
					mysqli_free_result($result3);
				}
			#mysqli_free_result($result);
		}
		?>
		
		<form action="companysearch.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to job search page: <input type="submit" name="submit" value="Back">
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