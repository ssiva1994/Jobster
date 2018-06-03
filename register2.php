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
        <h1 class="title">Company Register</h1>
        <hr/>
      </div>
    </div>
    <div class="main-login main-center"> 
      <form class="form-horizontal" method="post" action="register-proc2.php">

        <div class="form-group">
            <label for="email" class="cols-sm-2 control-label">Email(Username)</label>
            <div class="cols-sm-10">            
                <input type="text" class="form-control" name="cmail" placeholder="Enter your Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/>
                
            </div>
        </div>

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Company Name</label>
            <div class="cols-sm-10">
              
                
                <input type="text" class="form-control"  name="cname"  placeholder="Enter your company name"/>
             
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
            <label for="city" class="cols-sm-2 control-label">Headquaters City</label>
            <div class="cols-sm-10">
                
                <input type="input" class="form-control"  name="hqcity"  placeholder="Enter your headquarters city" />
               
            </div>
          </div>

		  <div class="form-group">
            <label for="state" class="cols-sm-2 control-label">Headquaters State</label>
            <div class="cols-sm-10">
                
                <input type="input" class="form-control"  name="hqstate"  placeholder="Enter your headquarters state" />
               
            </div>
          </div>
		  
          <div class="form-group">
            <label for="number" class="cols-sm-2 control-label">Phone Number</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="cphone"  placeholder="Phone number" pattern=".{10,10}"   required/>
               
            </div>
          </div>
		  
		  <div class="form-group">
            <label for="type" class="cols-sm-2 control-label">Type of Company</label>
            <div class="cols-sm-10" >
                
                <input type="input" class="form-control"  name="ctype"  placeholder="Enter the type of company" />
               
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

