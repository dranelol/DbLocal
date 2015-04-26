<?php

	include "login.php";

	if(isset($_SESSION["userType"]) == false)
	{	
		echo "Not logged in!";
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	
?>
<html>
<head>
<title>
Clear Session
</title>
</head>

<h3>Clear Session</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	if($sessionUser != "admin")
	{
		echo 'Not logged in as a admin!';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}

	echo "Logged in as: $sessionUser"; 
	if($sessionUser == "member")
	{
		echo "<br>Membership ID: " . $_SESSION['memberID'] . "<br>";
	}
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 
<br>
<br>
<?php
	
	$_SESSION["userType"] = null;
	$_SESSION["today"] = null;
	$_SESSION["memberID"] = null;
	
	echo "Cleared session variables!";
	
	echo '<br><a href ="index.php">Go to Index</a>';
?>