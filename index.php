<?php
	include "login.php";
	
	if(isset($_POST["userType"]))
	{
		$_SESSION['userType'] = $_POST["userType"];
		
		if($_SESSION['userType'] == "member")
		{
			if(isset($_POST["memberID"]))
			{
				$_SESSION['memberID'] = $_POST["memberID"];
			}
		}
		
		else
		{
			$_SESSION['memberID'] = "";
		}
	}

	else if(isset($_SESSION["userType"]) == false)
	{
		echo "Not logged in!";
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	
	if(isset($_SESSION["today"]) == false)
	{
		$date = "01/01/2015";
		
		$_SESSION["today"] = $date;
	}
	
	
	
	
	
?>

<html>
<head>
<title> 
Index for Janksby Database
</title>
</head>
<h3>Index</h3>

<body>

<?php 

	$sessionUser = $_SESSION['userType'];

	echo "Logged in as: $sessionUser"; 
	//$date = explode("/", $_SESSION["today"]);
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 
<br>
<br>

<?php

	if($_SESSION["userType"] == "member")
	{
		echo "Member ID: " . $_SESSION['memberID'] . "<br>";
		echo "<a href ='MovieListings.php'>Movie Listings</a>";
	}

?>


<br>
<a href ="LoginPage.php">Login Page</a>
<br>
<br>

</body>
</html>



