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
  <div class="row main">
    <div class="panel-heading">
      <div class="panel-title text-center">
        <h1 class="title">New Job Announcement</h1>
        <hr/>
      </div>
    </div>
    <div class="main-login main-center"> 
      <form class="form-horizontal" method="post" action="jobannouncement2.php">

        <div class="form-group">
            <label for="jobtitle" class="cols-sm-2 control-label">Job Title</label>
            <div class="cols-sm-10">            
                <input type="text" class="form-control" name="jtitle" placeholder="Enter the job title" />
                
            </div>
        </div>

          <div class="form-group">
            <label for="location" class="cols-sm-2 control-label">Job Location</label>
            <div class="cols-sm-10">
                <input type="text" class="form-control"  name="jlocation"  placeholder="Enter the job location"/>
            </div>
          </div>

          <div class="form-group">
            <label for="salary" class="cols-sm-2 control-label">Salaray Range</label>
            <div class="cols-sm-10">
                
                <input type="text" class="form-control" name="salary"  placeholder="Enter the salary range" />
                
            </div>
          </div>

          <div class="form-group">
            <label for="degree" class="cols-sm-2 control-label">Required Degree</label>
            <div class="cols-sm-10">
                
                <input type="text" class="form-control" name="degree"   placeholder="Enter the Minimum degree required"/>
               
            </div>
          </div>

          <div class="form-group">
            <label for="major" class="cols-sm-2 control-label">Required Major</label>
            <div class="cols-sm-10">
                
                <input type="input" class="form-control"  name="major"  placeholder="Enter the required major" />
               
            </div>
          </div>

		  <div class="form-group">
            <label for="deadlineOn" class="cols-sm-2 control-label">Deadline</label>
            <div class="cols-sm-10" >
                
                <input type="date" class="form-control"  name="deadlineOn"  placeholder="Enter in YYYY-MM-DD" />
               
            </div>
          </div>
		  
		  <div class="form-group">
            <label for="description" class="cols-sm-2 control-label">Description of Job</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="description"  placeholder="Enter the description of job" />
               
            </div>
          </div>

          <div class="form-group ">
            <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Post</button>
          </div>
      </form>
    </div>
  </div>
</div>  

