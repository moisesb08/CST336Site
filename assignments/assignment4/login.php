<?php
	session_start();
	$incorrect=false;
	if(isset($_POST['CustomerUsername']))
	{
		require 'db_connection.php';
		
		$sql = "SELECT *
				FROM CUSTOMER
				WHERE CustomerUsername = :CustomerUsername
				AND encryptedPassword = :encryptedPassword";
		$stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":CustomerUsername"=>$_POST['CustomerUsername'],":encryptedPassword" => hash("sha1", $_POST['password'])));
		$record = $stmt->fetch();
		if(empty($record))
		{
			$incorrect = true;
		}
		else
		{
			$sql = "INSERT INTO LOG(CustomerUsername, event)
					VALUES(:CustomerUsername, 'Logged In')";
			$stmt = $dbConn -> prepare($sql);
			$stmt -> execute(array(":CustomerUsername"=>$record['CustomerUsername']));
			
			$_SESSION['record']=$record;
			header("Location: index.php");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
</head>
<body>
	<form method="post">
		<h1>Abalone Store</h1>
		<h2>Login</h2>
		<?php
			if($incorrect)
			{
				echo'<h4>Incorrect username or password.</h4>';
				echo"<input type='text' name='CustomerUsername' value='".$_POST['CustomerUsername']."' maxLength='20' required></input>
					<input type='password' name='password' placeholder='Password' maxLength='25' required></input>
					<input class='Button Submit' type='submit' value='submit'>";
			}
			else
			{
				echo"<input type='text' name='CustomerUsername' placeholder='Username' maxLength='20' required></input>
					<input type='password' name='password' placeholder='Password' maxLength='25' required></input>
					<input class='Button Submit' type='submit' value='submit'>";
			}
		?>
	</form>
	<br>
	<form method="post" action="register.php"><button name='cart' type='register'>Register</button></form>
</body>
</html>
