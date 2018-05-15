<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Lab 3</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <style>
  	.container {
	overflow: hidden;
	background-color: #66c1e5;
	box-shadow: 0px 2px 4px 0px gray;
	}
			
	.container a {
	    float: left;
	    font-size: 15px;
	    color: white;
	    text-align: center;
	    padding: 12px 16px;
	    text-decoration: none;
	    font-family: inherit;
	}
	
	.dropdown1 {
	    float: left;
	    overflow: hidden;
	}
	
	.dropdown2 {
	    float: left;
	    overflow:hidden;
	}
	
	.dropdown1 .dropbtn {
	    font-size: 15px;    
	    border: none;
	    outline: none;
	    color: white;
	    padding: 12px 16px;
	    background-color: inherit;
	    font-family:inherit;
	}
	
	.dropdown2 .dropbtn {
	    font-size: 15px;    
	    border: none;
	    outline: none;
	    color: white;
	    padding: 12px 16px;
	    background-color: inherit;
	    font-family: inherit;
	}
	
	.container a:hover, .dropdown1:hover .dropbtn {
	    background-color: skyblue;
	    color:ghostwhite;
	}
	
	.container a:hover, .dropdown2:hover .dropbtn {
	    background-color: skyblue;
	    color:ghostwhite;
	}
	
	.dropdown-content {
	    display: none;
	    position: absolute;
	    background-color: #a8dcf0;
	    min-width: 160px;
	    box-shadow: 0px 4px 8px 0px #262626;
	    z-index: 1;
	}
	
	.dropdown-content a {
	    float: none;
	    color:white;
	    padding: 12px 16px;
	    text-decoration: none;
		display: block;
	    text-align: left;
	}
	
	.dropdown-content a:hover {
	    background-color: #262626;
	    color:white;
	    font-weight:600;
	}
	
	.dropdown1:hover .dropdown-content {
	    display: block;
	}
	
	.dropdown2:hover .dropdown-content {
	    display: block;
	}
	
	.dropdown1:hover .arrow {
		width: 0; 
		height: 0; 
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		border-top: 5px solid ghostwhite;
	}
	
	.dropdown2:hover .arrow {
		width: 0; 
		height: 0; 
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		border-top: 5px solid ghostwhite;
	}
	
	.arrow {
		float:right;
		width:0;
		height:0;
		border-top: 5px solid transparent;
		border-bottom: 5px solid transparent;
		border-left: 5px solid white;
	}
	
	.currentPage {
		background-color:#262626;
		font-weight:600;
	}
  	select {
  		background-color: black;
  		color:ghostwhite;
  		height:40px;
  		font-size: 20px;
  		width:224px;
  	}
  	.selectFrom {
  		margin:0;
  		background-color: black;
  		color:ghostwhite;
  		height:40px;
  		font-size: 20px;
  		width:157px;
  	}
  	.inputBox {
  		padding: 5px;
  		background-color: transparent;
  		color:black;
  		height:26px;
  		font-size: 20px;
  		width:43px;
  		box-shadow: 1px 1px 1px 0px #262626;
  	}
  	html body {
  		font-family:Courier;
  		background-color:ghostwhite;
		background-image:url(../../assignments/assignment1/images/pattern1.png);
		background-repeat:repeat;
		font-weight:100;
  	}
  	table {
  		margin:0px auto;
		border-collapse: collapse;
		border-spacing: 20px;
  	}
  	h1 {
  		text-align:center;
  	}
  	h3 {
  		font-family:Arial;
  		font-weight:100;
  	}
  	.submitButton {
  		font-size:20px;
  	}
  </style>
</head>

<body>
	<h1>Lab 3 - Length Converter</h1>
	<div class="container">
	<a href="../../assignments/assignment1/">Home</a>
	<a href="../../team_project/">Team Project</a>
  	<a href="#">Final Project</a>
	<div class="currentPage dropdown1">
  		<button class="dropbtn" id="buttonLabs">Labs&nbsp;<div class="arrow"></div></button>
  		<div class="dropdown-content">
    		<a href="../lab1/">Lab 1</a>
			<a href="../lab2/">Lab 2</a>
			<a class="currentPage" href="../lab3/">Lab 3</a>
			<a href="../lab4/">Lab 4</a>
			<a href="../lab5/login.php">Lab 5</a>
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
	<br>
	<?php
		$from="";
		$to="";
		$multiplier=1;
		$valid=true;
		if(isset($_GET["from"]))
			$from=$_GET["from"];
		if(isset($_GET["to"]))
			$to=$_GET["to"];
		if(isset($_GET["multiplier"]))
		{
			$multiplier = $_GET["multiplier"];
			if(!is_numeric($multiplier))
			{
				$valid=false;
			}
		}
	  	function optionsList($var)
		{
			echo "<option value='light-years'";
			if($var=='light-years')
				echo " selected";
			echo ">light-years</option>";
			echo "<option value='light-days'";
			if($var=='light-days')
				echo " selected";
			echo ">light-days</option>";
			echo "<option value='light-hours'";
			if($var=='light-hours')
				echo " selected";
			echo ">light-hours</option>";
			echo "<option value='light-minutes'";
			if($var=='light-minutes')
				echo " selected";
			echo ">light-minutes</option>";
			echo "<option value='light-seconds'";
			if($var=='light-seconds')
				echo " selected";
			echo ">light-seconds</option>";
			echo "<option value='AU'";
			if($var=='AU')
				echo " selected";
			echo ">AU</option>";
			echo "<option value='miles'";
			if($var=='miles')
				echo " selected";
			echo ">miles</option>";
			echo "<option value='yards'";
			if($var=='yards')
				echo " selected";
			echo ">yards</option>";
			echo "<option value='kilometers'";
			if($var=='kilometers')
				echo " selected";
			echo ">kilometers</option>";
			echo "<option value='meters'";
			if($var=='meters')
				echo " selected";
			echo ">meters</option>";
		}
	?>
	<table border="0">
	  	<tr>
  		<td>
  			<h3>Convert from:  </h3>
		</td>
		<td class="colorCell">
			<form method="get">
			<input size='10' class="inputBox" type="text" name="multiplier"
			<?php
				echo 'value="' . $multiplier . '">';
	  		?>
			<select name="from" class="selectFrom">
		  		<?php
					if($from=="")
						optionsList("light-seconds");
					else
						optionsList($from);
		  		?>
			</select>
		</td>
		</tr>
		<tr>
		<td>
			<h3>To: </h3>
		</td>
		<td class="colorCell">
			<select name="to">
		  		<?php
					if($to=="")
						optionsList("miles");
					else
						optionsList($to);
		  		?>
			</select>
		</td>
		</tr>
		<tr>
		<td colspan=2 align="center">
			<input class="submitButton" type="submit" value="Convert now!"><br>
	<?php
		$values = array(
			"AU"=>1/92955807.267433,
			"light-years"=>1/5878625373183.61,
			"light-days"=>(1/5878625373183.61)*365.25,
			"light-hours"=>(1/5878625373183.61)*8766,
			"light-minutes"=>(1/5878625373183.61)*525960,
			"light-seconds"=>(1/5878625373183.61)*31557600,
			"miles"=> 1,
			"yards"=>1760,
			"kilometers"=>1.609344,
			"meters"=>1609.344);
		if($from<>""&&$to<>"")
		{
			if(!$valid)
				echo "<h3>Please Enter Decimal Value</h3>";
			else
			{
				$calculation=$values[$to]/$values[$from];
				$calculation*=$multiplier;
				echo "<h3><b>" . $multiplier . "</b> " . $from . " = <b>" . $calculation . "</b> " . $to . "</h3>";
			}
		}
	?>
		</td>
		</tr>
		</form>
	</table>
</body>
</html>
