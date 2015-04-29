<?php

// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for cancelling a reservation


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
		
		$getShowingQuery = "select S.ID, S.SeatsAvailable from MovieShowing S, Reservation R where R.MovieShowingID = S.ID and R.ID = '$reservationID'";
		
		$getShowingResult = mysql_query($getShowingQuery) or die (mysql_error());
		
		if($getShowingRow = mysql_fetch_array($getShowingResult))
		{
			$showingID = $getShowingRow['ID'];
			$available = $getShowingRow['SeatsAvailable'];
			
			$available = $available + 1;
			
			$updateShowing = "update MovieShowing set SeatsAvailable='$available' where ID = '$showingID'";
			$updateShowingResult = mysql_query($updateShowing);
			
			$deleteReservationQuery = "delete from Reservation where ID = '$reservationID'";
			$deleteReservationResult = mysql_query($deleteReservationQuery) or die(mysql_error());
			
			echo "Successfully cancelled reservation!";
			
			echo "<br>";
			echo "<form action ='index.php'>";
			echo "<input type ='submit' value = 'Go back to index' >";  
			echo "</form>";   
		}
		
		
	}
	
	else
	{
		echo '<br>Got here illegally!';
		echo "<br>";
		echo "<form action ='index.php'>";
		echo "<input type ='submit' value = 'Go back to index' >";  
		echo "</form>";   
	}
	
	
			  
	  
?>

</body>
</html>