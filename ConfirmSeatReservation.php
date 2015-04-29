<?php

// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for reserving a seat at a movie showing.


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
Reserve a Seat
</title>
</head>

<h3>Reserve a Seat</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
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

	if(isset($_POST['row']) && isset($_POST['column']) && isset($_POST['showingID']) && isset($_POST['memberID']))
	{
		$row = $_POST['row'];
		$column = $_POST['column'];
		$showingID = $_POST['showingID'];
		$memberID = $_SESSION['memberID'];
		$member = $_POST['memberID'];
		
		
		
		// insert a new row into reservation table
		$insertReservation = "insert into 
										Reservation (MemberID, MembershipID, MovieShowingID, SeatRow, SeatColumn)
										values ($member, $memberID, $showingID, $row, $column)";
										
		$insertResult = mysql_query($insertReservation) or die(mysql_error());
		
		// we're assuming the reservation was legal; you can only get here if you clicked an enabled button which represents a seat/row for that movie showing
		
		// update the seating chart for that showing
		
		$seatQuery = "select S.SeatingChart, S.SeatsAvailable
				from MovieShowing S, Theater T 
				where S.ID = $showingID
				and S.TheaterID = T.ID";
				
		$seatingChart = mysql_query($seatQuery) or die(mysql_error());
		
		// unserialize the chart, set the relevant row/column, reserialize, update table
		
		while($rowResult = mysql_fetch_array($seatingChart))
		{
			$seatingChartArray = unserialize($rowResult['SeatingChart']);
			
			$seatingChartArray[$row][$column] = $memberID;
			
			$newSeatingChart = serialize($seatingChartArray);
			
			$available = $rowResult['SeatsAvailable'] - 1;
			
			$updateSeatingChart = "update MovieShowing
											    set SeatingChart = '$newSeatingChart',
												SeatsAvailable = '$available'
												where ID = $showingID";
												
			$updateResult = mysql_query($updateSeatingChart) or die(mysql_error());
			
		}
		
		echo "Seat confirmed!";
		
		echo "<br>";
		echo "<form action ='index.php'>";
		echo "<input type ='submit' value = 'Go back to index' >";  
		echo "</form>";   
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

