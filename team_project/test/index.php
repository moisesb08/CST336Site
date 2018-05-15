<?php
session_start();

require 'db_connection.php';
//check for log in
if(!isset($_SESSION['record']))
{
	header("Location: login.php");
}
else
{
	$record = $_SESSION['record'];
	$loggedin = "You are logged in ".$record['FirstName']." ".$record['LastName'].".";
	//displayAdmin();
}



function displayLowPriceTable()
{
	global $dbConn;
	$sql = "SELECT CategoryName, ProductName, Description, UnitPrice, QuantityInStock, ReleaseDate, ProductID
			FROM PRODUCT
			LEFT JOIN VENDOR ON PRODUCT.VendorID=VENDOR.VendorID
			LEFT JOIN CATEGORY ON PRODUCT.CategoryID=CATEGORY.CategoryID
			WHERE UnitPrice<40
			AND QuantityInStock>0 ORDER BY CategoryName, ProductName";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute();
	$records = $stmt -> fetchAll();
	
	if (empty($records))
	{
		echo'<h4>No products currently available under $40.</h4>';
	}
	else
	{
		echo '<table border="1">';
		echo '<tr>
		<th>Category</th>
    	<th>Product Name</th>
    	<th>Description</th>
    	<th>Price</th>
        <th>Quantity In Stock</th>
        <th> </th>
        </tr>
		';
		foreach($records as $record)
		{
			echo"<tr>";
			echo"<td>". $record['CategoryName']."</td>";
			echo"<td>". $record['ProductName']."</td>";
			echo"<td><form method='post'>";
			if(isset($_POST['showDescription']))
			{
				if($_POST['showDescription']==$record['ProductID'])
				{
					echo $record['Description']."  ";
					echo"<input type = 'hidden' name = 'browseBy' value ='Under $40'>";
					echo"<button name='hideDescription' type='submit' value='".$record['ProductID']."'>Hide Description</button>";
				}
				else {
					echo"<input type = 'hidden' name = 'browseBy' value ='Under $40'>";
					echo"<button name='showDescription' type='submit' value='".$record['ProductID']."'>Show Description</button>";
				}
			}
			else
			{
				echo"<input type = 'hidden' name = 'browseBy' value ='Under $40'>";
				echo"<button name='showDescription' type='submit' value='".$record['ProductID']."'>Show Description</button>";
			}
			echo"</td></form>";
			echo"<td>". $record['UnitPrice']."</td>";
			echo"<td>". $record['QuantityInStock']."</td>";
			echo"<td><form method='post' action='cart.php'><button name='ProductID' type='submit' value='".$record['ProductID']."'>Add to Cart</button></form></td>";
			echo"</tr>";
		}
		echo '</table>';
	}
}
function displayCategoryTable()
{
	global $dbConn;
	if($_POST['CategoryID']<3)
	{
		$typeID='ParentCategoryID';
		$ID = $_POST['CategoryID'];
	}
	else
	{
		$typeID='CategoryID';
		$ID = $_POST['CategoryID'];
	}
	$sql = "SELECT CategoryName, ProductName, Description, UnitPrice, QuantityInStock, ReleaseDate, ProductID
			FROM PRODUCT
			LEFT JOIN VENDOR ON PRODUCT.VendorID=VENDOR.VendorID
			LEFT JOIN CATEGORY ON PRODUCT.CategoryID=CATEGORY.CategoryID
			WHERE CATEGORY.".$typeID."=:".$typeID.
			" AND QuantityInStock>0 ORDER BY CategoryName, ProductName";
	$stmt = $dbConn -> prepare($sql);
	$typeID = ":".$typeID;
	$stmt -> execute(array($typeID => $ID));
	$records = $stmt -> fetchAll();
	
	if (empty($records))
	{
		echo'<h4>No products currently available under this category.</h4>';
	}
	else
	{
		echo '<table border="1">';
		echo '<tr>
		<th>Category</th>
    	<th>Product Name</th>
    	<th>Description</th>
    	<th>Price</th>
        <th>Quantity In Stock</th>
        <th> </th>
        </tr>
		';
		foreach($records as $record)
		{
			echo"<tr>";
			echo"<td>". $record['CategoryName']."</td>";
			echo"<td>". $record['ProductName']."</td>";
			echo"<td><form method='post'>";
			if(isset($_POST['showDescription']))
			{
				if($_POST['showDescription']==$record['ProductID'])
				{
					echo $record['Description']."  ";
					echo"<input type = 'hidden' name = 'browseBy' value ='Category'>";
					echo"<input type = 'hidden' name = 'CategoryID' value ='".$_POST['CategoryID']."'>";
					echo"<button name='hideDescription' type='submit' value='".$record['ProductID']."'>Hide Description</button>";
				}
				else {
					echo"<input type = 'hidden' name = 'browseBy' value ='Category'>";
					echo"<input type = 'hidden' name = 'CategoryID' value ='".$_POST['CategoryID']."'>";
					echo"<button name='showDescription' type='submit' value='".$record['ProductID']."'>Show Description</button>";
				}
			}
			else
			{
				echo"<input type = 'hidden' name = 'browseBy' value ='Category'>";
				echo"<input type = 'hidden' name = 'CategoryID' value ='".$_POST['CategoryID']."'>";
				echo"<button name='showDescription' type='submit' value='".$record['ProductID']."'>Show Description</button>";
			}
			echo"</form></td>";
			echo"<td>". $record['UnitPrice']."</td>";
			echo"<td>". $record['QuantityInStock']."</td>";
			echo"<td><form method='post' action='cart.php'><button name='ProductID' type='submit' value='".$record['ProductID']."'>Add to Cart</button></form></td>";
			echo"</tr>";
		}
		echo '</table>';
	}
}
function displayVendorTable()
{
	global $dbConn;
	$sql = "SELECT CategoryName, ProductName, Description, UnitPrice, QuantityInStock, ReleaseDate, ProductID
			FROM PRODUCT
			LEFT JOIN VENDOR ON PRODUCT.VendorID=VENDOR.VendorID
			LEFT JOIN CATEGORY ON PRODUCT.CategoryID=CATEGORY.CategoryID
			WHERE VENDOR.VendorID=:VendorID AND QuantityInStock>0 ORDER BY CategoryName, ProductName";
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(':VendorID' => $_POST['VendorID']));
	$records = $stmt -> fetchAll();
	
	if (empty($records))
	{
		echo'<h4>No products currently available under this Vendor.</h4>';
	}
	else
	{
		echo '<table border="1">';
		echo '<tr>
		<th>Category</th>
    	<th>Product Name</th>
    	<th>Description</th>
    	<th>Price</th>
        <th>Quantity In Stock</th>
        <th> </th>
        </tr>
		';
		foreach($records as $record)
		{
			echo"<tr>";
			echo"<td>". $record['CategoryName']."</td>";
			echo"<td>". $record['ProductName']."</td>";
			echo"<td><form method='post'>";
			if(isset($_POST['showDescription']))
			{
				if($_POST['showDescription']==$record['ProductID'])
				{
					echo $record['Description']."  ";
					echo"<input type = 'hidden' name = 'browseBy' value ='Vendor'>";
					echo"<input type = 'hidden' name = 'VendorID' value ='".$_POST['VendorID']."'>";
					echo"<button name='hideDescription' type='submit' value='".$record['ProductID']."'>Hide Description</button>";
				}
				else {
					echo"<input type = 'hidden' name = 'browseBy' value ='Vendor'>";
					echo"<input type = 'hidden' name = 'VendorID' value ='".$_POST['VendorID']."'>";
					echo"<button name='showDescription' type='submit' value='".$record['ProductID']."'>Show Description</button>";
				}
			}
			else
			{
				echo"<input type = 'hidden' name = 'browseBy' value ='Vendor'>";
				echo"<input type = 'hidden' name = 'VendorID' value ='".$_POST['VendorID']."'>";
				echo"<button name='showDescription' type='submit' value='".$record['ProductID']."'>Show Description</button>";
			}
			echo"</td></form>";
			echo"<td>". $record['UnitPrice']."</td>";
			echo"<td>". $record['QuantityInStock']."</td>";
			echo"<td><form method='post' action='cart.php'><button name='ProductID' type='submit' value='".$record['ProductID']."'>Add to Cart</button></form></td>";
			echo"</tr>";
		}
		echo '</table>';
	}
}
function getCategories()
{
	global $dbConn;
	$num=0;
	$sql = "SELECT *
			FROM CATEGORY
			WHERE CategoryID>:num";
	
	$stmt = $dbConn -> prepare($sql);
	
	$stmt -> execute(array(":num"=>$num));
	$records = $stmt -> fetchAll();
	echo '<br><br><center><form method="post" >';
	echo"<select name='CategoryID'>";
	foreach ($records as $record) {
		echo '<option value="'.$record['CategoryID'].'">'.$record['CategoryName'].'</option>';
	}
	echo"<select></br>";
	echo '<input type="submit" value="Submit"><input type = "hidden" name = "browseBy" value="'.$_POST['browseBy'].'"></form></center>';
}
function getVendors()
{
	global $dbConn;
	$sql = "SELECT *
			FROM VENDOR";
	
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute();
	$records = $stmt -> fetchAll();
	echo '<br><br><center><form method="post">';
	echo"<select name='VendorID'>";
	foreach ($records as $record) {
		echo '<option value="'.$record['VendorID'].'">'.$record['CompanyName'].'</option>';
	}
	echo"<select></br>";
	echo '<input type="submit" value="Submit"><input type = "hidden" name = "browseBy" value="'.$_POST['browseBy'].'"></form></center>';
}
function browseBy()
{
	echo'<h3>Browse By</h3>';
	echo '<form method="post"><table border="1"><tr>
		<th><input type="submit" name="browseBy" value="Category"></th>
		<th><input type="submit" name="browseBy" value="Vendor"></th>
		<th><input type="submit" name="browseBy" value="Under $40"></th>
		</tr></table></form>';
}

function displayAdmin()
{
	echo '<form method = "post" action = "manageProduct.php" >
			<input type="submit" name="adminButton" value="Admin" onclick="return checkAdmin()" style="float: right"/>
			</form>';	
}

function isAdmin()
{
	global $dbConn,$record;
	$sql = "SELECT *
			FROM ADMIN
			WHERE CustomerUsername=:CustomerUsername
			AND Active>0;";
			
	$stmt = $dbConn -> prepare($sql);
	$stmt -> execute(array(":CustomerUsername"=>$record["CustomerUsername"]));
	$rec = $stmt -> fetch();
	
	if(empty($rec))
		return false;
	return true;
}

?>

<!DOCTYPE html>
<html>
<style>

body {
	background: #A8EEFF;
	font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
}

button, input[type=submit] {
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    background-color: #00CD97;
}

button, input[name=adminButton]{
	color: white;
	padding:14px 20px;
	margin: 8px 0;
	border: 1;
	cursor: pointer;
	background-color: #00BFEC;
}

select {
	width: 20%;
}

input[type=submit]:hover, button:hover {
    opacity: 0.8;
}

select {
  -webkit-appearance: none;
}
.logo {
    height: auto; 
    width: auto; 
    max-width: 100px; 
    max-height: 100px;
}
table {
	width:100%;
}
p {
	text-align: right;
}
</style>
<head>
	<title>Store</title>
	<script>
		function confirmLogout(event) {
			var logout = confirm("Do you really want to log out?");
			if (!logout)
				return false;
			else
				return true;
		}
		function checkAdmin(event) {
			<?
			if(isAdmin())
				echo"return true;";
			else echo"confirm('Sorry, you must be an administrator to access this page.');return false;";
			?>
		}
	</script>
</head>
<body>
		<div align="center" class="storelogo">
			<h1>Abalone Store</h1>
   			<img src="logonotext.png" alt="Logo" class="logo">
  		</div>
	<?php echo "<p>$loggedin</p>" ?>
	
	
	<form method="post" action="logout.php">
	<input type="submit" value="Logout" onclick="return confirmLogout()" style="float: right"/>
	</form>
	<?php displayAdmin() ?>
	<form method="post" action="cart.php">
	<input type="submit" name="CheckCart" value="Cart" />
	</form>
	<?php
	if(isset($_POST['browseBy']))
	{
		switch ($_POST['browseBy']) {
			case 'Category':
				getCategories();
				break;
			
			case 'Vendor':
				getVendors();
				break;
				
			case 'Under $40':
				displayLowPriceTable();
				break;
			
			default:
				
				break;
		}
	}
	else
	{
		if(!isset($_POST['CategoryID'])&&!isset($_POST['VendorID']))
			browseBy();
	}
	
		$_SESSION['record']=$record;
	?>
	<br>
	<?php
	if(isset($_POST['CategoryID']))
	{
		displayCategoryTable();
	}
	if(isset($_POST['VendorID']))
	{
		displayVendorTable();
	}
	?>
	<form action="change_password.php" style="float: right">
	<input type="submit" value="Change Password">
	</form>
	<form method="post" action="index.php">
	<input type="submit" value="Home" />
	</form>
</body>
</html>