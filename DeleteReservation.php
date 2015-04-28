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
Delete a Reservation
</title>
</head>

<h3>
Delete a Reservation
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	
	if($sessionUser != "admin")
	{
		echo 'You do not have permission to view this page.';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	
	echo "Logged in as: $sessionUser"; 
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 

<br>
<br>

<?php

	if(isset($_POST['reservationToDelete']))
	{
		$reservationID = $_POST['reservationToDelete'];
		
		$deleteReservationQuery = "delete from Reservation where ID=$reservationID";

	
		if(mysql_query($deleteReservationQuery) or die(mysql_error()))
		{
			echo "Reservation number $reservationID has been canceled.<br>";
		}
				
		else
		{
			echo "<br>Could not delete reservation.";
			echo '<br><a href ="DeleteReservation.php">Go Back</a>';			
		}	
	}
		
	else	
	{
		$reservationQueryResult = mysql_query("select * from Reservation order by MembershipID, MemberID;") or die(mysql_error());	

		if(mysql_num_rows($reservationQueryResult))
		{
			echo "<form action='DeleteReservation.php' method='post'>";
			echo "Delete Reservation: ";
			echo "<select name='reservationToDelete'>";
			
			while($reservationRow = mysql_fetch_array($reservationQueryResult))
			{
					$reservationID = $reservationRow['ID'];
					$movieShowingID = $reservationRow['MovieShowingID'];
					$membershipID = $reservationRow['MembershipID'];
					$memberID = $reservationRow['MemberID'];
					
					$movieShowingResult = mysql_fetch_array(mysql_query("select * from MovieShowing where ID=$movieShowingID;"));
					
					$cinemaID = $movieShowingResult['CinemaID'];
					$movieID = $movieShowingResult['MovieID'];
					$date = $movieShowingResult['ShowDate'];
					$time = $movieShowingResult['ShowTime'];
					
					$titleQuery = mysql_fetch_array(mysql_query("Select Title from Movie where ID=$movieID;"));
					$title = $titleQuery['Title'];
					$cinemaQuery = mysql_fetch_array(mysql_query("Select Name from Cinema where ID=$cinemaID;"));
					$cinemaName = $cinemaQuery['Name'];
					
					echo "<option value='$reservationID'>Member: ($membershipID-$memberID) \"$title\" at $cinemaName on $date $time</option>";
			}
			
			echo "</select>";
			echo "<br><br>";
			echo "<input type='submit' value='Delete Reservation'>";
			echo "</form>";
		}
		
		else
		{
			echo "No existing movie showings.<br>";
		}
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>

</body>
</html>