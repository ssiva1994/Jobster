<?php 
session_start();
if(!isset($_SESSION['username']) && isset($_COOKIE['username']) && !empty($_COOKIE['username']) ) {
  $_SESSION['username'] = $_COOKIE['username'];
}
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home2.php"><i class="glyphicon glyphicon-home"> </i> Jobster</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home2.php">Home</a></li>
      <?php 
      if( (isset($_COOKIE['username']) && !empty($_COOKIE['username'])) || (isset($_SESSION['username']) ))
        { echo "<li><a href='logout.php'>Logout</a></li>";}
      ?>
    </ul>
  </div>
</nav>
