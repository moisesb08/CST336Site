<?php
/* STEP 2 *******************/
session_start();
?>
<form method="post" action="logout.php">
<input type="submit" value="Logout" onclick="return confirmLogout()"/>
</form>
<br>
<br>
<?php
require 'db_connection.php';
if(!isset($_SESSION['login'])){
header("Location: login.php");
}
function updateURL($username, $url)
{
	global $dbConn; 
        
        $sql = "UPDATE LAB8
                SET profilePic = :url
                WHERE username = :username";
                
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute( array(":url" => $url,
                                ":username" => $username));
}

 if (!isset ( $_SESSION['username']))  {
     if (isset ($_POST['loginForm'])) {
        
        $sql = "SELECT *
                FROM LAB8
                WHERE username = :username
                AND encryptedPassword = :password";
                
        $stmt = $dbConn -> prepare($sql);
        $stmt -> execute( array(":username" => $_POST['username'],
                                ":password" => sha1($_POST['password'])));
        $record = $stmt->fetch();
        
        if (!empty($record)) {
            $_SESSION['username'] = $record['username'];
            $_SESSION['profilePic'] = $record['profilePic'];
            if (!file_exists("profilePics/" . $record['username'])) {
               mkdir("profilePics/" . $record['username']);
            }
        } else {
            // Wrong username / password
            header("Location: login.php");    
		}
    
     }
	 else{
	 	header("Location: logout.php");
	 }
 }
 

function createThumbnail($location){
    $sourcefile = imagecreatefromstring(file_get_contents($_FILES["fileName"]["tmp_name"]));
    $newx = 100; $newy = 100; //new size
    if (imagesx($sourcefile) > imagesy($sourcefile))// landscape orientation
    {   
    	$newy = round($newx/imagesx($sourcefile) * imagesy($sourcefile));
    }
    else// portrait orientation
    {
    	$newx = round($newy/imagesy($sourcefile) * imagesx($sourcefile));
    }

    $thumb = imagecreatetruecolor($newx,$newy);
    imagecopyresampled($thumb, $sourcefile, 0,0, 0,0, $newx, $newy,     
    	imagesx($sourcefile), imagesy($sourcefile));
	if($_FILES["fileName"]["type"]=="image/png")
	{
		imagepng($thumb,$location);
	}
	elseif($_FILES["fileName"]["type"]=="image/gif")
	{
		imagegif($thumb,$location);
	}
	else
	{
        if (!file_exists("profilePics/" . $_SESSION['username']))
        {
               mkdir("profilePics/" . $_SESSION['username']);
        }
	 	imagejpeg($thumb,$location);
	}
    }

 
/* STEP 3 *******************/
  if (isset($_FILES['fileName'])) {
     
	 $allowedTypes=array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
	 if (!in_array($_FILES["fileName"]["type"],  $allowedTypes ) )
	 {
	 	echo '<script>alert("Invalid type (Upload only gif, jpg, jpeg, or png files)");</script>';
     }
	 else
	 {
	 	echo '<script>alert("Upload Successful!");</script>';
	 	//remove all files in folder
	     $directory = 'profilePics/'.$_SESSION['username'];
	     foreach(glob("{$directory}/*") as $file)
		 {
		    if(!is_dir($file)) {
		        unlink($file);
		    }
		 }

		 if($_FILES["fileName"]["type"]=="image/png")
		 {
		 	$extension=".png";
		 }
		 elseif($_FILES["fileName"]["type"]=="image/gif")
		 {
		 	$extension=".gif";
		 }
		 else
		 {
		 	$extension=".jpg";
		 }
		 $fileName = date("h_ia").$extension;
		 $_SESSION['profilePic'] = $fileName;
		 updateURL($_SESSION['username'],$fileName);
		 
	     createThumbnail("profilePics/" . $_SESSION['username'] . "/" . $fileName);
	 }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Profile</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <script>
  	function confirmLogout(event) {
	var logout = confirm("Do you really want to log out?");
	if (!logout)
		return false;
	else
		return true;
	}
  </script>
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
			<a class="currentPage" href="../lab5/login.html">Lab 5</a>
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
  <div>
  <br><br>
  
  <?php
  
   if (empty($_SESSION['profilePic'])) {
           echo "<h2> Welcome  " . $_SESSION['username'] . "!</h2>";  
           echo "<table id='picTable'><tr><td><img class='profilepic' src='User_Circle.png'></td></tr></table><br/>";
       
   } else {
           echo "<h2> Welcome  " . $_SESSION['username'] . "!</h2>";           
           echo "<table id='picTable'><tr><td><img class='profilepic' src='" ."profilePics/". $_SESSION['username'] . "/" . $_SESSION['profilePic'] . "'></td></tr></table><br/>";
       
   }

  ?>
  
  </div>
  <!--- Step 1 ****************-->
  <div align="left" class="upload">
  <form   method="post" enctype="multipart/form-data">
      <br/>
      
      Select File to update profile Picture:
      
      <input type="file" name="fileName" />
      <br/>
      <input type="submit" name="loginForm">
      
  </form>
  
   </div>
</body>
</html>