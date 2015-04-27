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
Reset database
</title>
</head>

<h3>
Reset database
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

	//$reloadQuery = implode("\n", file('mainDB.sql')); 
	//$reloadResult = mysql_query($reloadQuery) or die(mysql_error());
	exec("mysql -u groupH -p cs4601_groupH --password=MaximumJank < mainDB.sql");
	echo "Database reloaded successfully with test data!";
	echo "<br><br>";
	echo "You should also reset the reservation and movie showing data to default values.";
	
	echo '<br><a href ="ResetReservations.php">Reset Reservation and Movie Showing Data</a>';
	//$user="groupH";
    //$password="MaximumJank";
     //$database="cs4601_groupH";
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
	
			  
			  
?>

</body>
</html>