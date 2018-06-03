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
			echo "<br> You applications are: " . "<br>";
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "<br>";
				echo "JobID    :";echo $row["jid"] . "<br>";
				echo "Applied On    :";echo $row["appliedDate"] . "<br>";
		
			}
			mysqli_free_result($result);
		}
?>
<?php
//closing database
mysqli_close($connection);
?>