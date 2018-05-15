<?php
	require 'db_connection.php';
	function displayTable()
	{
		global $dbConn;
		$sql = "SELECT gameID, title, imageUrl
				FROM game";
		$stmt = $dbConn -> prepare($sql);
		$stmt -> execute();
		$records = $stmt -> fetchAll();
		
		if (empty($records))
		{
			echo'<h4>No information available</h4>';
		}
		else
		{
			echo '<table class="picsTable" border="1">';
			$row=0;
			$col=0;
			foreach($records as $record)
			{
				if($row==0)
				{
					echo "<tr>";
				}
				echo"<td>";
				echo'<img class="smallPic" id="'.$record['gameID'].'" src="'.$record['imageUrl'].'" alt="'.$record['title'].'">';
				echo"</td>";
				$row+=1;
				if($row==5)
				{
					$row=0;
					$col+=1;
					echo "</tr>";
				}
			}
			echo '</table>';
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

  <title>Assignment 5 - Xbox One Game Library</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css.css" />
</head>

<body>
  <div class="container">
	<a href="../../assignments/assignment1/">Home</a>
	<a href="../../team_project/">Team Project</a>

	<div class="dropdown1">
  		<button class="dropbtn" id="buttonLabs">Labs&nbsp;<div class="arrow"></div></button>
  		<div class="dropdown-content">
    		<a href="../../labs/lab1/">Lab 1</a>
			<a href="../../labs/lab2/">Lab 2</a>
			<a href="../../labs/lab3/">Lab 3</a>
			<a href="../../labs/lab4/">Lab 4</a>
			<a href="../../labs/lab5/login.php">Lab 5</a>
  		</div>
	</div>
	<div class="currentPage dropdown2">
  		<button class="dropbtn" id="buttonAssignments">Assignments&nbsp;<div class="arrow"></div></button>
		<div class="dropdown-content">
			<a href="../assignment1/">Assignment 1</a>
			<a href="../assignment2/">Assignment 2</a>
			<a href="../assignment3/">Assignment 3</a>
			<a href="../../team_project/">Assignment 4</a>
			<a class="currentPage" href="../../assignments/assignment5/">Assignment 5</a>
		</div>
  	</div>
	
</div>
  <div>
 <!--*********STEP 1********* -->
   <h1> XBOX ONE Video Game Library</h1>
   <p><center>Hover over an image to learn more.</center></p>
	<hr>
	<div id="text"></div>
   	<?php
   		displayTable();
   	?>
 	<hr>
 	<br>
 	<br>
 	
  </div>
  
  
  <script>
  		$("body").on('mouseover','img',function(){
  			var gameId=$(this).attr('id');
  			//$("#text").text(gameId);
  			$.ajax({
            type: "get",
             url: "gameInfo.php",
        dataType: "json",
            data: { "game_id": gameId },
            success: function(data,status) {
                 //alert(data["description"]);
                 $("#text").html("<table id='info' border='1'><tr><th><img id='largePic' src='"+data['imageUrl']+"' alt='"+data['title']+"' height='120' width='100'></th>"
                 	+"<th><h2>" + data["title"] + "</h2>$"+ data["price"]+ "<br><br>ESRB Rating: "+data["rating"]+"<br>Release Date: "+data["releaseDate"]
                 	+"</th></tr>"+"<tr><td colspan='2'><p class='description'>"+data["description"]+"</p></td></tr></table>");
              },
            complete: function(data,status) { //optional, used for debugging purposes
                  //alert(status);
              }
         });
  		})
  		
       <!--*********STEP 2********* -->
         $("#zipCode").change(  function(){ 
             //alert(  $("#zipCode").val()      );
         
         } ); //end changeEvent
          
      
  </script>
  
</body>
</html>