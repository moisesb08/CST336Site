<?php
session_start();
$_SESSION['login'] = "true";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Lab 5: Moises Bernal</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="css.css" />
</head>

<body id="wrapper">
	<div class="container">
	<a href="../../assignments/assignment1/">Home</a>
	<a href="../../team_project/">Team Project</a>

	<div class="currentPage dropdown1">
  		<button class="dropbtn" id="buttonLabs">Labs&nbsp;<div class="arrow"></div></button>
  		<div class="dropdown-content">
    		<a href="../lab1/">Lab 1</a>
			<a href="../lab2/">Lab 2</a>
			<a href="../lab3/">Lab 3</a>
			<a href="../lab4/">Lab 4</a>
			<a class="currentPage" href="../lab5/login.php">Lab 5</a>
  		</div>
	</div>
	<div class="dropdown2">
  		<button class="dropbtn" id="buttonAssignments">Assignments&nbsp;<div class="arrow"></div></button>
		<div class="dropdown-content">
			<a href="../../assignments/assignment1/">Assignment 1</a>
			<a href="../../assignments/assignment2/">Assignment 2</a>
			<a href="../../assignments/assignment3/">Assignment 3</a>
			<a href="../../team_project/">Assignment 4</a>
			<a href="../../assignments/assignment5/">Assignment 5</a>
		</div>
  	</div>
	
</div>
  <div align="center">
    
    <h2> Login </h2>
    
    <form method="post" action="profile.php">
        
        Username: <input type="text" name="username" required/><br /><br />
        Password: <input type="password" name="password" required/><br /><br />
        
        <input type="submit" name="loginForm" />
        
    </form>
    <br>
    <br />
    (username: bern3822, Password: password)<br/>
    
  </div>
</body>
</html>