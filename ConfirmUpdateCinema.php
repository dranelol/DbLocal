<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for update cinema
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
Update Cinema Confirmation
</title>
</head>

<h3>
Update Cinema Confirmation
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
	if(isset($_POST['cinemaID']) && isset($_POST['cinemaName']) && isset($_POST['cinemaAddress']) && isset($_POST['cinemaPhoneNumber']))
	{
		$cinemaID = $_POST['cinemaID'];
		$cinemaName = $_POST['cinemaName'];
		$cinemaAddress = $_POST['cinemaAddress'];
		$cinemaPhoneNumber = $_POST['cinemaPhoneNumber'];
		
		$cinemaUpdate = "update Cinema set Name = '$cinemaName', Address = '$cinemaAddress', PhoneNumber = '$cinemaPhoneNumber' where ID = '$cinemaID'";
		$cinemaResult = mysql_query($cinemaUpdate) or die(mysql_error());
		
		echo "Cinema successfully updated!";
	}
	
	else
	{
		echo "Got here illegally!";
		
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";	  
	  
?>

</body>
</html>