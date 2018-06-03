<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "project22";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(isset($_POST['cmail']) && isset($_POST['cname']) && isset($_POST['password']) && isset($_POST['confirm']) && isset($_POST['hqcity']) && isset($_POST['hqstate']) && isset($_POST['cphone']) && isset($_POST['ctype']))
{
	$cmail = mysqli_real_escape_string($connection, $_POST['cmail']);
	//$Uemail = $_POST['Uemail'];
	
	$cname = mysqli_real_escape_string($connection, $_POST['cname']);
	//$Ufirst_name = $_POST['Ufirst_name'];
	
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	//$Upassword = $_POST['Upassword'];
	
	$confirm = mysqli_real_escape_string($connection, $_POST['confirm']);
	//$confirm = $_POST['confirm'];
	
	$hqcity = mysqli_real_escape_string($connection, $_POST['hqcity']);
	//$Uaddress = $_POST['Uaddress'];
	
	$hqstate = mysqli_real_escape_string($connection, $_POST['hqstate']);
	
	$cphone = mysqli_real_escape_string($connection, $_POST['cphone']);
	//$Uphone = $_POST['Uphone'];
	
	$ctype = mysqli_real_escape_string($connection, $_POST['ctype']);

	if($password != $confirm) {

		echo "Please enter matching passwords";
		echo "<a href='register.php'>Register</a>";
	}	
}


else {
	header("Location: login.php");
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
$query = "SELECT * FROM Company as c WHERE c.cmail = '$cmail' ";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result)>0)
{
	echo("User already exists.");
}
else
{
$query1 ="SELECT COUNT(*) AS countcid FROM Company";
$result1 = mysqli_query($connection, $query1);
if(!$result1) 
{
	echo("Database query failed.");
	echo "<a href='register.php'>Register</a>";
} 
$count = '';
while($row = mysqli_fetch_assoc($result1))
{
	$count = $row["countcid"]+30001;
}
$query2 = "INSERT INTO UserLogin (username,password,lastupdatedon) VALUES ('$cmail','$password',now())";
$result2 = mysqli_query($connection, $query2);
$query3 = "INSERT INTO Company (cid,username,cname,hqcity,hqstate,cmail,cphone,ctype) VALUES ('$count','$cmail','$cname','$hqcity','$hqstate','$cmail','$cphone','$ctype') ";
$result3 = mysqli_query($connection, $query3);

if(!$result2 OR !$result3) 
{
	header("Location: register1.php");
} else 
{
	header("Location: login.php");
}
}
?>


