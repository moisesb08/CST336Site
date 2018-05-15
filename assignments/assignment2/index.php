<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Assignment 2</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="css/assignment2.css">
</head>

<body>
<div class="container">
	<a href="../assignment1/">Home</a>
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
			<a class="currentPage" href="#">Assignment 2</a>
			<a href="../assignment3/">Assignment 3</a>
			<a href="../../team_project/">Assignment 4</a>
			<a href="../assignment5/">Assignment 5</a>
		</div>
  	</div>
	
</div>
<h1>Assignment 2: Making First Moves in Chess Randomly</h1>
<?php
		$chessBoard;
		$symName = array(
			"Queen"=>"&#9818;",
			"King"=>"&#9819;",
			"Rook"=>"&#9820;",
			"Bishop"=>"&#9821;",
			"Knight"=>"&#9822;",
			"Pawn"=>"&#9823;",
		);
		$bgColor = array("w", "b");
		$whiteMove = rand(0,9);
		$blackMove = rand(0,9);
		$whiteOption = rand(0,1);
		$blackOption = rand(0,1);
		echo "<table cellpadding='5' border='1'>";
		for($row=0;$row<8;$row++)
		{
			echo "<tr>";
			for($col=0;$col<8;$col++)
			{
				if($row % 2 == 0)
				{
					if($row>3)
						echo "<td class='wSym " . $bgColor[$col % 2] . "Cell'>";
					else
						echo "<td class='bSym " . $bgColor[$col % 2] . "Cell'>";
				}
				else
				{
					if($row>3)
						echo "<td class='wSym " . $bgColor[($col+1) % 2] . "Cell'>";
					else
						echo "<td class='bSym " . $bgColor[($col+1) % 2] . "Cell'>";
				}
				switch ($row)
				{
					case 0:
						switch ($col) {
							case 0:
								echo $symName["Rook"];
								break;
							case 1:
								if($blackMove!=8)
									echo $symName["Knight"];
								else
									echo " ";
								break;
							case 2:
								echo $symName["Bishop"];
								break;
							case 3:
								echo $symName["King"];
								break;
							case 4:
								echo $symName["Queen"];
								break;
							case 5:
								echo $symName["Bishop"];
								break;
							case 6:
								if($blackMove!=9)
									echo $symName["Knight"];
								else
									echo " ";
								break;
							case 7:
								echo $symName["Rook"];
								break;
							default:
								break;
						}
						break;
					case 1:
						if($col==$blackMove)
							echo " ";
						else
							echo $symName["Pawn"];
						break;
					case 2:
						if($blackMove==8)
						{
							if(($col==0 && $blackOption=0)||($col==2 && $blackOption=1))
								echo $symName["Knight"];
						}	
						else if($blackMove==9)
						{
							if(($col==5 && $blackOption=0)||($col==7 && $blackOption=1))
								echo $symName["Knight"];
						}
						else if($col==$blackMove&&$blackOption==0)
							echo $symName["Pawn"];
						else
							echo " ";
						break;
					case 3:
						if($col==$blackMove&&$blackOption==1)
							echo $symName["Pawn"];
						else
							echo " ";
						break;
					case 4:
						if($col==$whiteMove&&$whiteOption==1)
							echo $symName["Pawn"];
						else
							echo " ";
						break;
					case 5:
						if($whiteMove==8)
						{
							if(($col==0 && $whiteOption=0)||($col==2 && $whiteOption=1))
								echo $symName["Knight"];
						}	
						else if($whiteMove==9)
						{
							if(($col==5 && $whiteOption=0)||($col==7 && $whiteOption=1))
								echo $symName["Knight"];
						}
						else if($col==$whiteMove&&$whiteOption==0)
							echo $symName["Pawn"];
						else
							echo " ";
						break;
					case 6:
						if($col==$whiteMove)
							echo " ";
						else
							echo $symName["Pawn"];
						break;
					default:
						switch ($col) {
							case 0:
								echo $symName["Rook"];
								break;
							case 1:
								if($whiteMove!=8)
									echo $symName["Knight"];
								else
									echo " ";
								break;
							case 2:
								echo $symName["Bishop"];
								break;
							case 3:
								echo $symName["King"];
								break;
							case 4:
								echo $symName["Queen"];
								break;
							case 5:
								echo $symName["Bishop"];
								break;
							case 6:
								if($whiteMove!=9)
									echo $symName["Knight"];
								else
									echo " ";
								break;
							case 7:
								echo $symName["Rook"];
								break;
							default:
								break;
						}
						break;
				}
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "<h2> White moves <b>";
		if($whiteMove<8)
			echo "Pawn";
		else
			echo "Knight";
		echo "</b> and Black moves <b>";
		if($blackMove<8)
			echo "Pawn.";
		else
			echo "Knight.";
		echo "</b></h2>";
?>
</body>
</html>