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
	$startApplication=false;
	$age=false;
	if(isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"]) && isset($_POST["age"]))
	{
		$firstName = $_POST["firstName"];
		$lastName = $_POST["lastName"];
		$email = $_POST["email"];
		$age = $_POST["age"];
		$startApplication=true;
	}
	function scaleList($var=-1)
	{
		echo "<option value='' disable selected";
		echo "> Select </option>";
		echo "<option value=4";
		if($var==4)
			echo " selected";
		echo ">an Expert</option>";
		echo "<option value=3";
		if($var==3)
			echo " selected";
		echo ">Proficient</option>";
		echo "<option value=2";
		if($var==2)
			echo " selected";
		echo ">Competent</option>";
		echo "<option value=1";
		if($var==1)
			echo " selected";
		echo ">an Advanced Beginner</option>";
		echo "<option value=0";
		if($var==0)
			echo " selected";
		echo ">a Novice</option>";
	}
	function educationList($var="")
	{
		echo "<option value='' disable selected";
		echo "> Select </option>";
		echo "<option value='phd'";
		if($var=='phd')
			echo " selected";
		echo ">Doctoral/Professional Degree</option>";
		echo "<option value='masters'";
		if($var=='masters')
			echo " selected";
		echo ">Master's Degree</option>";
		echo "<option value='bachelors'";
		if($var=='bachelors')
			echo " selected";
		echo ">Bachelor's Degree</option>";
		echo "<option value='associates'";
		if($var=='associates')
			echo " selected";
		echo ">Associate Degree</option>";
		echo "<option value='certificate'";
		if($var=='certificate')
			echo " selected";
		echo ">Online Certificate(s)</option>";
		echo "<option value='college'";
		if($var=='college')
			echo " selected";
		echo ">Attended College (No Degree)</option>";
		echo "<option value='hs'";
		if($var=='hs')
			echo " selected";
		echo ">High School Diploma/GED</option>";
		echo "<option value='less'";
		if($var=='less')
			echo " selected";
		echo ">Less than High School</option>";
	}
	function jobList($var="")
	{
		echo "<option value='' disable selected";
		echo "> Select </option>";
		echo "<option value='Application Developer'";
		echo ">Application Developer</option>";
		echo "<option value='Full-Stack Developer'";
		echo ">Full-Stack Developer</option>";
		echo "<option value='Software Engineer'";
		echo ">Software Engineer</option>";
		echo "<option value='Mobile Game Developer'";
		echo ">Mobile Game Developer</option>";
		echo "<option value='Front End Developer - Intern'";
		echo ">Front End Developer - Intern</option>";
	}
	function yearsList($num, $var=-1)
	{
		echo "<option value='' disable selected";
		echo "> Select </option>";
		for($i=0; $i<$num; $i++)
		{
			echo "<option value=" . $i;
			if($var==$i)
				echo " selected";
			echo ">" . $i . " year";
			if($i!=1)
				echo "s";
			echo "</option>";
		}
		echo "<option value=" . $num;
		if($var>=$num)
			echo " selected";
		echo ">" . $num . " years";
		echo "</option>";
	}
?>		
		<?php
		$contact = <<<EOD
		<div class="formBox">
		<form method="post" id="info">
		<fieldset id="around"><legend><h1>Careers</h1></legend>
		<h2>Contact Info</h2>
		<input type="text" name="firstName" placeholder="First Name" required>
		<input type="text" name="lastName" placeholder="Last Name" required>
		<input type="email" name="email" placeholder="Email Address" required>
		<label class="label">Are you 18 or older?</label>
			<input type="radio" name="age" value=1 required><span class="age-select">Yes</span>
			<input type="radio" name="age" value=0 ><span class="age-select">No</span>
		<br>
		<br>
		<input class="submitButton" type="submit" value="Start Application"/>
		</fieldset>
		</form>
EOD;
		if(!$startApplication)
		{
			echo $contact;
		}
		?>
	<?php
	//
	if($startApplication)
	{
		if($age)
		{   echo '<div class="formBox box2">';
			echo "<form method='post' action='complete.php' id='info'>";
			echo "";
			echo '<fieldset id="around"><legend><h1>Careers</h1></legend>';
			echo '<h2>Employment Application</h2>';
			echo '<label class="label">Select the open position you are applying for: </label>';
			echo '<select name="position" required>';
				jobList();
			echo '</select><br><br>';
			echo '<label class="label">I have extensive knowledge in...(check all that apply):</label><br><br>';
			echo '<input type="checkbox" name="extensive[]" value="mysql">MySQL<br>';
			echo '<input type="checkbox" name="extensive[]" value="javascript">JavaScript<br>';
			echo '<input type="checkbox" name="extensive[]" value="html">HTML and CSS<br>';
			echo '<input type="checkbox" name="extensive[]" value="java">Java<br>';
			echo '<input type="checkbox" name="extensive[]" value="php">PHP<br>';
			echo '<input type="checkbox" name="extensive[]" value="unity">Unity (Game Engine)<br>';
			echo '<input type="checkbox" name="extensive[]" value="unreal">Unreal (Game Engine)<br>';
			echo '<input type="checkbox" name="extensive[]" value="csharp">C#<br>';
			echo '<input type="checkbox" name="extensive[]" value="c">C<br>';
			echo '<input type="checkbox" name="extensive[]" value="cpp">C++<br><br>';
			echo '<label class="label">I have some knowledge in...(check all that apply):</label><br><br>';
			echo '<input type="checkbox" name="some[]" value="mysql">MySQL<br>';
			echo '<input type="checkbox" name="some[]" value="javascript">JavaScript<br>';
			echo '<input type="checkbox" name="some[]" value="html">HTML and CSS<br>';
			echo '<input type="checkbox" name="some[]" value="java">Java<br>';
			echo '<input type="checkbox" name="some[]" value="php">PHP<br>';
			echo '<input type="checkbox" name="some[]" value="unity">Unity (Game Engine)<br>';
			echo '<input type="checkbox" name="some[]" value="unreal">Unreal (Game Engine)<br>';
			echo '<input type="checkbox" name="some[]" value="csharp">C#<br>';
			echo '<input type="checkbox" name="some[]" value="c">C<br>';
			echo '<input type="checkbox" name="some[]" value="cpp">C++<br>';
			echo '<br><label class="label">I would consider myself to be: </label><br>';
			echo '<select name="oop" required>';
				scaleList();
			echo '</select>';
			echo ' in object oriented programming.<br>';
			echo '<select name="ge" required>';
				scaleList();
			echo '</select>';
			echo ' in working with game engines.<br>';
			echo '<select name="wd" required>';
				scaleList();
			echo '</select>';
			echo ' in web development.<br><br>';
			echo '<label>Select the years of experience in a similar position:</label><br>';
			echo '<select name="experience" required>';
				yearsList(5,-1);
			echo '</select><br><br>';
			echo '<label>Select your highest level of education:</label><br>';
			echo '<select name="education" required>';
				educationList();
			echo '</select>';
			echo '	<input class="majors" list="majors" name="major" placeholder="Enter Major (if applicable)">
					<datalist id="majors">
    					<option value="Computer Science">
		    			<option value="Computer Engineering">
		    			<option value="Software Engineering">
		    			<option value="Electrical Engineering">
		    			<option value="Mathematics">
		  			</datalist><br>
		  			<input type="checkbox" name="progress" value=true>currently in progress<br><br>';
			echo '<label>I live within 30 miles from San Jose (ZIP 95050). </label>';
			echo '<input type="checkbox" name="distance" value=1><br>';
			echo '<a href="https://www.zip-codes.com/distance_calculator.asp?zip1=&zip2=95050&submit=Search" target="_blank">Calculate Distance</a><br><br>';
			echo '<label>I am willing to relocate. </label><input type="checkbox" name="relocate" value=1><br><br>';
			echo '<label>Please copy and paste your resume below:</label><br><br>';
			echo '<textarea name="resume" placeholder="--Paste Resume Here--" rows=10></textarea>';
			echo '<table id="submitReset"><tr><td><input class="submitButton" type="submit" value="Submit Application"/>';
			echo '</td><td><input type="reset"></form></td></tr></table></fieldset>';
			echo'<input type="hidden" name="firstName" value=' . $firstName . '>';
			echo'<input type="hidden" name="lastName" value=' . $lastName . '>';
			echo'<input type="hidden" name="email" value=' . $email . '>';
		}
		else
		{
			echo '<div class="formBox box2">';
			echo "<form id='info'><fieldset id='around'><legend><h1>Careers</h1></legend>";
			echo'<h2>Sorry. You must be 18 years of age or older to apply for a position at our company.</h2>';
			echo'<h3>Thank you for your interest.</h3>';
			echo '</fieldset></form>';
		}
	}
	?>
</div>

</body>
</html>