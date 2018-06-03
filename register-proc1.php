<?php 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "project22";
$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if( isset($_POST['smail']) && isset($_POST['sfname']) && isset($_POST['slname']) && isset($_POST['password']) && isset($_POST['confirm']) && isset($_POST['scity']) && isset($_POST['sstate']) && isset($_POST['sphone']) && isset($_POST['university']) && isset($_POST['enrolledon']) && isset($_POST['degree']) && isset($_POST['major']) && isset($_POST['status']) && isset($_POST['gpa']) && isset($_POST['interest']) && isset($_POST['resume']))
{	
	$smail = mysqli_real_escape_string($connection, $_POST['smail']);
	//$Uemail = $_POST['Uemail'];
	
	$sfname = mysqli_real_escape_string($connection, $_POST['sfname']);
	//$Ufirst_name = $_POST['Ufirst_name'];
	
	$slname = mysqli_real_escape_string($connection, $_POST['slname']);
	//$Ulast_name = $_POST['Ulast_name'];
	
	$password = mysqli_real_escape_string($connection, $_POST['password']);
	//$Upassword = $_POST['Upassword'];
	
	$confirm = mysqli_real_escape_string($connection, $_POST['confirm']);
	//$confirm = $_POST['confirm'];
	
	$scity = mysqli_real_escape_string($connection, $_POST['scity']);
	//$Uaddress = $_POST['Uaddress'];
	
	$sstate = mysqli_real_escape_string($connection, $_POST['sstate']);
	
	$sphone = mysqli_real_escape_string($connection, $_POST['sphone']);
	//$Uphone = $_POST['Uphone'];
	
	$university = mysqli_real_escape_string($connection, $_POST['university']);
	
	$enrolledon = mysqli_real_escape_string($connection, $_POST['enrolledon']);
	
	$degree = mysqli_real_escape_string($connection, $_POST['degree']);
	
	$major = mysqli_real_escape_string($connection, $_POST['major']);
	
	$status = mysqli_real_escape_string($connection, $_POST['status']);
	
	$gpa = mysqli_real_escape_string($connection, $_POST['gpa']);
	
	$interest = mysqli_real_escape_string($connection, $_POST['interest']);
	
	$resume = mysqli_real_escape_string($connection, $_POST['resume']);

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
$query = "SELECT * FROM Student as s WHERE s.smail = '$smail' ";
$result = mysqli_query($connection, $query);

if(mysqli_num_rows($result)>0)
{
	echo("User already exists.");
}
else
{

	$query1 ="SELECT COUNT(*) AS countsid FROM Student;";

	$result1 = mysqli_query($connection, $query1);

	if(!$result1)
	{
		echo("Database query failed.");
		echo "<a href='register.php'>Register</a>";
	} 
	$count = '';
	while($row = mysqli_fetch_assoc($result1)) 
	{
		$count = $row["countsid"]+50001;
	}
	#echo "$count";
	$query2 = "INSERT INTO UserLogin (username,password,lastupdatedon) VALUES ('$smail','$password',now());";
	$result2 = mysqli_query($connection, $query2);
	$query3 = "INSERT INTO Student (sid,username,sfname,slname,scity,sstate,smail,sphone,university,enrolledon,status,degree,major,gpa,interest,resume) VALUES ('$count','$smail','$sfname','$slname','$scity','$sstate','$smail','$sphone','$university','$enrolledon','$status','$degree','$major','$gpa','$interest','$resume');";
	$result3 = mysqli_query($connection, $query3);


	if(!$result2 OR !$result3)
	{	
		header("Location: register1.php");
	} 
	else 
	{
		header("Location: login.php");
	}
}
?>


