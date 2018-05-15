<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Lab 2</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="css/lab2.css">
</head>
<body>
	<div class="container">
	<a href="../../assignments/assignment1/">Home</a>
	<a href="../../team_project/">Team Project</a>

	<div class="currentPage dropdown1">
  		<button class="dropbtn" id="buttonLabs">Labs&nbsp;<div class="arrow"></div></button>
  		<div class="dropdown-content">
    		<a href="../lab1/">Lab 1</a>
			<a class="currentPage" href="../lab2/">Lab 2</a>
			<a href="../lab3/">Lab 3</a>
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
	<h1>Lab 2: Detecting odd, even, and prime numbers</h1>
	<?php
		echo"<table cellpadding='5' border='1'>";
		
		$primeCount=0;
		$oddCount=0;
		function isPrime($number)
		{
			if($number<2)
				return false;
			if($number==2)
				return true;
			for($i=2;$i<$number;$i++)
			{
				if($number % $i == 0)
					return false;
			}
			return true;
		}
		for($i=0;$i<10;$i++)
		{
			echo "<tr>";
			for($j=0;$j<10;$j++)
			{
				$num=rand(1,100);
				if($num%2==0)
				{
					echo"<td class='styleEven";
					if(isPrime($num))
					{
						echo" stylePrime";
						$primeCount++;
					}
					echo"'>";
				}
				else
				{
					echo"<td class='styleOdd";
					$oddCount++;
					if(isPrime($num))
					{
						echo" stylePrime";
						$primeCount++;
					}
					echo"'>";
				}
				echo $num;
				echo "</td>";
			}
			echo "</tr>";
		}
		echo"</table><div id='count'>";
		echo"<h2>Odd numbers <b class='oddColor'> &#9632; </b>: " . $oddCount . " (" . $oddCount . "%)</h2>";
		echo"<h2>Even numbers <b class='evenColor'> &#9632; </b>: " . (100-$oddCount) . " (" . (100-$oddCount) . "%)</h2>";
		echo"<h2>Prime numbers (<b>bold</b>): " . $primeCount . " (" . $primeCount . "%)</h2></div>";
	?>
	
</body>
</html>