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
TITLE
</title>
</head>

<h3>
HEADING
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

	
	if($sessionUser != "member")
	{
		echo 'Not logged in as a member!';
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
	if(isset($_POST['reservationToCancel']))
	{
		$reservationID = $_POST['reservationToCancel'];
		
		$deleteReservationQuery = "delete from Reservation where ID = '$reservationID'";
		$deleteReservationResult = mysql_query($deleteReservationQuery) or die(mysql_error());
		
		echo "Successfully cancelled reservation!";
		
		echo '<br><a href ="index.php">Go to Index</a>';	
	}
	
	else
	{
		echo '<br>Got here illegally!';
		echo '<br><a href ="index.php">Go to Index</a>';
	}
	
	
			  
	  
?>

</body>
</html>