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
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-home"> </i> Jobster</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="row main">
    <div class="panel-heading">
      <div class="panel-title text-center">
        <h1 class="title">Student Register</h1>
        <hr/>
      </div>
    </div>
    <div class="main-login main-center"> 
      <form class="form-horizontal" method="post" action="register-proc1.php">

        <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Email(Username)</label>
            <div class="cols-sm-10">            
                <input type="text" class="form-control" name="smail" placeholder="Enter your Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                
            </div>
        </div>

          <div class="form-group">
            <label for="email" class="cols-sm-2 control-label">First name</label>
            <div class="cols-sm-10">
              
                
                <input type="text" class="form-control"  name="sfname"  placeholder="Enter your first name"/>
             
          </div>
        </div>

        <div class="form-group">
            <label for="username" class="cols-sm-2 control-label">Last Name</label>
            <div class="cols-sm-10">
                
                <input type="text" class="form-control"  name="slname"  placeholder="Enter your last name"/>
                
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="cols-sm-2 control-label">Password</label>
            <div class="cols-sm-10">
                
                <input type="password" class="form-control" name="password"  placeholder="Enter your Password" pattern=".{4,}" required/>
                
            </div>
        </div>

        <div class="form-group">
            <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
            <div class="cols-sm-10">
                
                <input type="password" class="form-control" name="confirm"   placeholder="Confirm your Password" pattern=".{4,}"   required />
               
            </div>
        </div>

        <div class="form-group">
            <label for="city" class="cols-sm-2 control-label">City</label>
            <div class="cols-sm-10">
                
                <input type="input" class="form-control"  name="scity"  placeholder="Enter the City you live in"/>
            </div>   
        </div>
			
		<div class="form-group">
            <label for="state" class="cols-sm-2 control-label">State</label>
            <div class="cols-sm-10">
                
                <input type="input" class="form-control"  name="sstate"  placeholder="Enter the State you live in"/>
            </div>   
        </div>
			
        <div class="form-group">
            <label for="number" class="cols-sm-2 control-label">Phone Number</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="sphone"  placeholder="Enter your 10 digit Phone number" pattern=".{10,10}"   required/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="university" class="cols-sm-2 control-label">University</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="university"  placeholder="Enter the university name"/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="enrolledon" class="cols-sm-2 control-label">Date of Enrollment</label>
            <div class="cols-sm-10" >
                
                <input type="date" class="form-control"  name="enrolledon"  placeholder="Enter in YYYY-MM-DD"/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="degree" class="cols-sm-2 control-label">Degree</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="degree"  placeholder="Enter your degree"/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="major" class="cols-sm-2 control-label">Major</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="major"  placeholder="Enter your major"/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="status" class="cols-sm-2 control-label">Status</label>
            <div class="cols-sm-10" >
                <select	name="status" class="form-control">
				  <option value="Currently Enrolled">Currently Enrolled</option>
				  <option value="Graduated">Graduated</option>
				</select>
                <!-- <input type="input" class="form-control"  name="status"  placeholder="Current status"/> -->
               
            </div>
        </div>
		<div class="form-group">
            <label for="gpa" class="cols-sm-2 control-label">GPA</label>
            <div class="cols-sm-10" >
                
                <input type="number" class="form-control"  name="gpa"  placeholder="Enter your gpa (out of 4.0)" min="0.0" max="4.0" step="0.01"/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="interest" class="cols-sm-2 control-label">Interest</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="interest"  placeholder="Enter your interest"/>
               
            </div>
        </div>
		<div class="form-group">
            <label for="resume" class="cols-sm-2 control-label">Resume</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="resume"  placeholder="Paste your resume"/>
               
            </div>
        </div>

            <div class="form-group ">
              <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
            </div>
            <div class="login-register">
              <a href="login.php">Login</a>
            </div>
      </form>
    </div>
  </div>
</div>  

