<?php

// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Clears all reservations from database, resets all seating charts for movie showings to their default state



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
Reset Reservations
</title>
</head>

<h3>Reset Reservations</h3>
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
	
	$seatingQuery = "select S.ID, S.SeatingChart, T.ID, T.SeatingRows, T.SeatingColumns
			from MovieShowing S, Theater T
			where S.TheaterID = T.ID";
	$seatingResult = mysql_query($seatingQuery) or die(mysql_error());
	while($row = mysql_fetch_array($seatingResult))
	{
		$seatingRows = array();
		for($x = 0; $x < $row['SeatingColumns'];$x++)
		{
			$seatingRows[$x] = array();
			for($y = 0; $y < $row['SeatingRows'];$y++)
			{
				$seatingRows[$x][$y] = '0';
			}
		}
		//$seatingRows[2][3] = '1';
		$seatingChartSerialized = serialize($seatingRows);

		$updateQuery = "update MovieShowing 
				set SeatingChart = '$seatingChartSerialized'
				where ID = '$row[0]'";
		$updateSeatingResult = mysql_query($updateQuery) or die(mysql_error());
		
	}

	$newQuery = "select * from MovieShowing where ID = 1";
	$newResult = mysql_query($newQuery) or die(mysql_error());
	while($row = mysql_fetch_array($newResult))
	{
		$dumb = unserialize($row['SeatingChart']);
		echo "<br><br>";
	}
	
	$deleteReservationsQuery = "delete from Reservation";
	$deleteResult = mysql_query($deleteReservationsQuery) or die(mysql_error());
	
	echo "Reservations and movie showing data reset!";
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>
