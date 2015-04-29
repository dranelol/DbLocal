<?php

// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Sets the date for the session


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
Set Today's Date
</title>
</head>

<h3>
Set Today's Date
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

	
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

	// CODE STARTS HERE
	echo "<form action='index.php' method = 'post'>";
	echo "<input type='date' name='today'>";
	echo "<br><br>";
	echo "<input type='submit' value='Set Date'>";
	echo "</form>";
			  
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";     
?>

</body>
</html>