<?php
	session_start();
	$record = $_SESSION['record'];
	require 'db_connection.php';
	
	if(isset($_POST['password']))
	{
		$sql = "SELECT *
				FROM CUSTOMER
				WHERE CustomerUsername = :CustomerUsername
				AND encryptedPassword = :encryptedPassword";
		$stmt = $dbConn -> prepare($sql);
		$stmt -> execute(array(":CustomerUsername"=>$record['CustomerUsername'],":encryptedPassword" => hash("sha1", $_POST['password'])));
		$record = $stmt->fetch();
		$updated=false;
		if(empty($record))
			$incorrect = true;
		else
			$incorrect = false;
		if($_POST['newPassword1']==$_POST['newPassword2'])
		{
			$passwordMatch=true;
			if(!$incorrect)
			{
				$sql = "UPDATE CUSTOMER
						SET encryptedPassword=:encryptedPassword
						WHERE CustomerUsername = :CustomerUsername";
				$stmt = $dbConn -> prepare($sql);
				$stmt -> execute(array(":encryptedPassword" => hash("sha1", $_POST['newPassword1']),":CustomerUsername"=>$record['CustomerUsername']));
				$updated=true;
			}
		}
		else
		{
			$passwordMatch=false;
		}
		$errors = array('Incorrect Password' => $incorrect, 'Passwords do NOT match.'=>!$passwordMatch, 'Password was NOT updated.' => !$updated);
	}
	function containsError($errors)
	{
		foreach ($errors as $error => $value)
		{
			if($value)
				return true;
		}
		return false;
	}
	function displayErrors($errors)
	{
		echo "<div class='errorContainer'>";
		foreach ($errors as $error => $value)
		{
			if($value)
				echo "<h5>".$error."</h5>";
		}
		echo "</div>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>
	<script>
	function confirmLogout(event) {
		var logout = confirm("Do you really want to log out?");
		if (!logout)
			return false;
		else
			return true;
	}
</script>
</head>
<body>
	<form method="post" action="logout.php">
	<input type="submit" value="Logout" onclick="return confirmLogout()"/>
	</form>
	<form method="post">
		<h1>Abalone Store</h1>
		<h2>Update Password</h2>
		<?php
			if(isset($_POST['password']))
			{
				#checkErrors
				if(containsError($errors))
				{
					displayErrors($errors);
					echo'<table>
					<tr><td>Password: </td><td colspan="3"><input class="longInput" type="password" name="password" placeholder="Password" maxLength="25" required></td></tr>
					<tr><td>New Password: </td><td><input class="longInput" type="password" name="newPassword1" placeholder="New Password" maxLength="25" required></td>
						<td>Confirm New Password: </td><td><input class="longInput" type="password" name="newPassword2" placeholder="Confirm New Password" maxLength="25" required></td></tr>
					<tr><td colspan="2"><input class="Button Submit" type="submit" value="submit"></td>
					<td colspan="2" class="ResetCell"><input class="Button Reset" type="reset" value="reset"></td></tr>
					</table>';
				}
				if($updated)
					echo'<h4>Your password was successfuly updated.</h4>';
			}
			else
			{
				echo'<table>
					<tr><td>Password: </td><td colspan="3"><input class="longInput" type="password" name="password" placeholder="Password" maxLength="25" required></td></tr>
					<tr><td>New Password: </td><td><input class="longInput" type="password" name="newPassword1" placeholder="New Password" maxLength="25" required></td>
						<td>Confirm New Password: </td><td><input class="longInput" type="password" name="newPassword2" placeholder="Confirm New Password" maxLength="25" required></td></tr>
					<tr><td colspan="2"><input class="Button Submit" type="submit" value="submit"></td>
					<td colspan="2" class="ResetCell"><input class="Button Reset" type="reset" value="reset"></td></tr>
					</table>';
			}
		?>
	</form>
	
	<br>
	<form method="post" action="index.php"><button name='home' type='home'>Home</button></form>
</body>
</html>
