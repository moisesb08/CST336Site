<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Assignment 3</title>
  <meta name="description" content="">
  <meta name="author" content="Moises Bernal">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="css/assignment3.css">
</head>

<body>
<h1>Assignment 3: Employment Application Form</h1>
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
			<a href="../assignment2/">Assignment 2</a>
			<a class="currentPage" href="../assignment3/">Assignment 3</a>
			<a href="../../team_project/">Assignment 4</a>
			<a href="../assignment5/">Assignment 5</a>
		</div>
  	</div>
</div>
<br>
<?php
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	if(!isset($_POST["otherPosition"]))
	{
		$edValue = array('less'=>0,'lessProgress'=>0,'hsProgress'=>0,'hs'=>1,'collegeProgress'=>2,
			'college'=>3,'certificateProgress'=>3,'certificate'=>4,'associatesProgress'=>5,
			'associates'=>6,'bachelorsProgress'=>7,'bachelors'=>8,'mastersProgress'=>9,
			'masters'=>10,'phdProgress'=>11,'phd'=>12);
		$redo=false;
		$position = $_POST["position"];
		if(isset($_POST["extensive"]))
			$extensive = $_POST["extensive"];//
		else
			$extensive = array();
		if(in_array('csharp', $extensive)||in_array('java', $extensive)||in_array('cpp', $extensive)||in_array('javascript', $extensive))
			$extensive[]='oopl';
		if(in_array('unity', $extensive)||in_array('unreal', $extensive))
			$extensive[]='gameEngine';
		if(isset($_POST["some"]))
			$some = $_POST["some"];
		else
			$some = array();
		if(in_array('csharp', $some)||in_array('java', $some)||in_array('cpp', $some)||in_array('javascript', $some))
			$some[]='oopl';
		if(in_array('unity', $some)||in_array('unreal', $some))
			$some[]='gameEngine';
		$major = strtolower($_POST["major"]);//
		$oop = $_POST["oop"];
		$ge = $_POST["ge"];
		$wd = $_POST["wd"];
		$experience = $_POST["experience"];
		$education = $_POST["education"];
		if(isset($_POST["progress"]))
			$education.="Progress";
		if(isset($_POST["distance"]))
			$distance = TRUE;
		else
			$distance = FALSE;
		if(isset($_POST["relocate"]))
			$relocate = TRUE;
		else
			$relocate = FALSE;
	}
	else
		$redo=true;
?>		
<?php
	$allPositions =array('Full-Stack Developer','Software Engineer','Mobile Game Developer','Application Developer','Front End Developer - Intern');
	function validPosition($pos)
	{
		switch ($pos) {
			case 'Full-Stack Developer':
				$Extensive = array('javascript', 'html', 'php');
				$Some = array('mysql');
				$Majors = array('any');
				$Other = array('oop'=>4, 'ge'=>0, 'wd'=>3, 'experience'=>5, 'education'=>'masters', 'relocate'=>true);
				break;
			case 'Software Engineer':
				$Extensive = array();
				$Some = array('php','html','mysql');
				$Majors = array('computer science', 'computer engineering', 'software engineering', 'mathematics');
				$Other = array('oop'=>2, 'ge'=>0, 'wd'=>1, 'experience'=>1, 'education'=>'bachelors', 'relocate'=>true);
				break;
			case 'Mobile Game Developer':
				$Extensive = array('gameEngine');
				$Some = array('oopl');
				$Majors = array('computer science', 'software engineering', 'computer engineering');
				$Other = array('oop'=>1, 'ge'=>3, 'wd'=>1, 'experience'=>1, 'education'=>'bachelors', 'relocate'=>false);
				break;
			case 'Application Developer':
				$Extensive = array('oopl');
				$Some = array('gameEngine', 'mysql');
				$Majors = array('any');
				$Other = array('oop'=>3, 'ge'=>0, 'wd'=>2, 'experience'=>2, 'education'=>'mastersProgress', 'relocate'=>false);
				break;
			case 'Front End Developer - Intern':
				$Extensive = array('oopl');
				$Some = array('html');
				$Majors = array('computer science', 'software engineering', 'computer engineering');
				$Other = array('oop'=>1, 'ge'=>0, 'wd'=>1, 'experience'=>0, 'education'=>'bachelorsProgress', 'relocate'=>true);
				break;
			default:
				return FALSE;
		}
		if (!validExtensive($Extensive)||!validSome($Some)||!validMajors($Majors)||!validOther($Other))
					return FALSE;
				return TRUE;
	}
	function validExtensive($Extensive)
	{
		global $extensive;
		foreach ($Extensive as $extValue) {
			if(!in_array($extValue, $extensive))
				return false;
		}
		return true;
	}
	function validSome($Some)
	{
		global $some,$extensive;
		foreach ($Some as $someValue) {
			if(!in_array($someValue, $some)&&!in_array($someValue, $extensive))
				return false;
		}
		return true;
	}
	function validMajors($Majors)
	{
		global $major;
		$validMajor=false;
		if(in_array('any', $Majors))
			$validMajor=TRUE;
		else
		{
			foreach ($Majors as $possibleMajor)
			{
				if($major==$possibleMajor)
					$validMajor=true;
			}
		}
		return $validMajor;
	}
	function validOther($Other)
	{
		global $oop, $ge, $wd, $experience, $relocate, $distance, $education,$edValue;
		if($Other['oop']<=$oop && $Other['ge']<=$ge && $Other['wd']<=$wd && $Other['experience']<=$experience)
		{
			if($distance||$relocate||(!$Other['relocate']))
			{
				if($edValue[$education]<$edValue[$Other['education']])
					return false;
			}
			else
				return false;
		}
		else
			return false;
		return true;
	}
	function jobList()
	{
		echo "<option value='' disable selected";
		echo "> Select </option>";
		echo "<option value='Do not apply.'";
		echo ">Do not apply.</option>";
	}
	function addJob($job)
	{
		echo "<option value='";
		echo $job . "'";
		echo ">";
		echo $job . "</option>";
	}
	if($redo)
	{
		$newPosition=$_POST["otherPosition"];
		if($newPosition=='Do not apply.')
		{
			echo '<div class="formBox"><form id="info"><fieldset id="around">';
			echo '<legend><h1>Careers</h1></legend><h2>Completed</h2>';
			echo '<label class="label">Thank you for your interest. Please check at a later time for new openings.</label><br><br>';
			echo '</fieldset></form></div>';
		}
		else
		{
			echo '<div class="formBox"><form id="info"><fieldset id="around">';
			echo '<legend><h1>Careers</h1></legend><h2>Application Submitted</h2>';
			echo '<label class="label">Thank you for applying for the ' . $newPosition . ' position, ' . $firstName . ' ' . $lastName . '. ';
			echo '</label><label class="label"><h4>We will contact you at ' . $email . ' after we review your application. Expect an email within 3 weeks.</h4></label><br><br>';
			echo '</fieldset></form></div>';
		}
	}
	else
	{
		$qualifiedPositions = array();
		foreach ($allPositions as $pos) {
			if(validPosition($pos))
				$qualifiedPositions[]=$pos;
		}
		if(in_array($position, $qualifiedPositions))
		{
			echo '<div class="formBox"><form id="info"><fieldset id="around">';
			echo '<legend><h1>Careers</h1></legend><h2>Application Submitted</h2>';
			echo '<label class="label">Thank you for applying for the ' . $position . ' position, ' . $firstName . ' ' . $lastName . '. ';
			echo '</label><label class="label"><h4>We will contact you at ' . $email . ' after we review your application. Expect an email within 3 weeks.</h4></label><br><br>';
			echo '</fieldset></form></div>';
		}
		else if(count($qualifiedPositions)==0)
		{
			echo '<div class="formBox"><form id="info"><fieldset id="around">';
			echo '<legend><h1>Careers</h1></legend><h2>Completed</h2>';
			echo '<label class="label">Thank you for applying for the ' . $position . ' position, ' . $firstName . ' ' . $lastName . '. ';
			echo 'Unfortunately you do not meet the basic requirements for this position or any other open position at this time.';
			echo '</label><label class="label"><h4>Please check at a later time for new openings.</h4></label><br><br>';
			echo '</fieldset></form></div>';
		}
        else
        {
        	echo '<div class="formBox"><form method="post" id="info"><fieldset id="around">';
			echo '<legend><h1>Careers</h1></legend><h2>Other Positions</h2>';
			echo '<label class="label">Thank you for applying for the ' . $position . ' position, ' . $firstName . ' ' . $lastName . '. ';
			echo 'Unfortunately you do not meet the basic requirements for this position.';
			echo '</label><label class="label"><h4>However, we did find that you meet the requirement for ';
			if(count($qualifiedPositions)==1)
				echo '1 position. ';
			else
				echo count($qualifiedPositions) . ' positions. ';
			echo 'Please select a position and click submit if you wish to submit the application. </h4></label><br>';
			echo '<center><select name="otherPosition" required>';
				echo "<option value='' disable selected";
				echo "> Select </option>";
				echo "<option value='Do not apply.'";
				echo ">Do not apply.</option>";
				foreach ($qualifiedPositions as $job) {
					addJob($job);
				}
			echo '</select></center><br><br>';
			echo '<input type="hidden" name="firstName" value=' . $firstName . '>';
			echo '<input type="hidden" name="lastName" value=' . $lastName . '>';
			echo '<input type="hidden" name="email" value=' . $email . '>';
			echo '<input class="submitButton" type="submit" value="Finish"/>';
			echo '</fieldset></form></div>';
        }
	}
	
?>

</body>
</html>