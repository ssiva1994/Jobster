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

<?php 

if(isset($_POST['jtitle']) && isset($_POST['jlocation']) && isset($_POST['salary']) && isset($_POST['degree']) && isset($_POST['major']) && isset($_POST['deadlineOn']) && isset($_POST['description']))
{
	$jtitle = mysqli_real_escape_string($connection, $_POST['jtitle']);
		
	$jlocation = mysqli_real_escape_string($connection, $_POST['jlocation']);
		
	$salary = mysqli_real_escape_string($connection, $_POST['salary']);
		
	$degree = mysqli_real_escape_string($connection, $_POST['degree']);
		
	$major = mysqli_real_escape_string($connection, $_POST['major']);
		
	$deadlineOn = mysqli_real_escape_string($connection, $_POST['deadlineOn']);
	
	$description = mysqli_real_escape_string($connection, $_POST['description']);
	
}


else 
{
	header("Location: jobannouncement1.php");
}

?>

<?php 
$resource = $connection->query("select c.cid
from Company as c
where c.cmail = '" . $_SESSION['username'] ."';");
$row = $resource->fetch_assoc();
$cid = $row['cid'];

$query ="SELECT COUNT(*) AS countjid FROM JobAnnouncement";
$result = mysqli_query($connection, $query);
if(!$result) {
	echo("Database query failed.");
	echo "<a href='jobannouncement1.php'></a>";
} 
$count = '';
while($row1 = mysqli_fetch_assoc($result)) {
	$count = $row1["countjid"]+10001;
}

$query2 = "INSERT INTO JobAnnouncement (jid,cid,jtitle,jlocation,salary,degree,major,postedOn,deadlineOn,description) VALUES ('$count','$cid','$jtitle','$jlocation','$salary','$degree','$major',now(),'$deadlineOn','$description') ";
$result2 = mysqli_query($connection, $query2);

if($result2) 
		{
			echo "Job announcement made. . <br>";
			
			$query3 = "select sid from companyconnection where cid='$cid';";
			$result3 = mysqli_query($connection, $query3);
			
			if($result3)
			{
				while($row3 = mysqli_fetch_assoc($result3))
				{
					$query4 = "INSERT INTO JobPush (jid,cid,sid,pushDate,pushstatus) VALUES ('$count','$cid','".$row3['sid']."',now(),'Not Read') ";
					$result4 = mysqli_query($connection, $query4);
					
					if($result4)
					{
						?>
						<form action="home2.php" method="post">
						<?php echo "<br>"; ?>
						Click here to return back to home page: <input type="submit" name="submit" value="Back">
						</form>
			<?php
					}	
					else
					{
						echo "Error: "  . "<br>" . mysqli_error($connection);
			?>
						<form action="home2.php" method="post">
						<?php echo "<br>"; ?>
						Click here to return back to home page: <input type="submit" name="submit" value="Back">
						</form>
			<?php
					}
				}
			}
			else
			{
				echo "Error: "  . "<br>" . mysqli_error($connection);
			?>
				<form action="home2.php" method="post">
				<?php echo "<br>"; ?>
				Click here to return back to home page: <input type="submit" name="submit" value="Back">
				</form>
			<?php
			}
			
			
		}
		else
		{
			echo "Error: "  . "<br>" . mysqli_error($connection);
?>
			<form action="home2.php" method="post">
			<?php echo "<br>"; ?>
			Click here to return back to home page: <input type="submit" name="submit" value="Back">
			</form>
<?php
		}
	
?>

