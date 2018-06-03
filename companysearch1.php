<?php
session_start();
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
} else {
	header("Location: login.php");
	exit;
}
$companyname = $_POST['companyname'];

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
	<div class="panel-heading">
	<?php
		if(empty($companyname))
		{ 
	?>
		<form action="companysearch.php" method="post">
		Search Keyword cannot be empty. <br>
		Click here the return to search page: <input type="submit" name="submit" value="Back">
		</form>
	</div>
</div>	
		<?php } 
		else
		{
			$query = "select * from company as c
			where c.cname like '%" . $companyname . "%';";
			$result = mysqli_query($connection, $query);
			if(mysqli_num_rows($result) == 0)
			{ 
				echo "<br> Sorry there are no matching companies.";
			}
			if(!$result) {
				die("Database query failed.");
			} ?>
			<form action="companysearch2.php" method="get">
			<?php
			while($row = mysqli_fetch_assoc($result)) 
			{
				echo "Company ID:"; echo $row["cid"] . "<br>";
				echo "Company Name :"; echo $row["cname"] . "<br>";
				echo "Company Headquarters City:"; echo $row["hqcity"] . "<br>";
				echo "Company Headquarters State:"; echo $row["hqstate"] . "<br>";
				echo "Company Mail:"; echo $row["cmail"] . "<br>";
				echo "Company Phone Number:"; echo $row["cphone"] . "<br>";
				echo "Company Type:"; echo $row["ctype"] . "<br>"; ?>
				
				Click here to follow this company: <input type="submit" name="companyid" value=<?php echo rawurlencode($row['cid']); ?>> <br>
				
			</form>
	<?php	}
		}
		?>
		<form action="companysearch.php" method="post">
		<?php echo "<br>"; ?>
		Click here to return back to job search page: <input type="submit" name="submit" value="Back">
		</form>
		

</body>
</html>