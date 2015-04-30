<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Main index for the site


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
	
	if(isset($_POST['today']))
	{
		//$_SESSION["today"] = $_POST['today'];
		
		$today = $_POST['today'];
		$today = explode("-", $today);
		
		$todayFormatted = date("m/d/Y", mktime(0,0,0, $today[1], $today[2], $today[0]));
		
		//echo $todayFormatted;
		$_SESSION["today"] = $todayFormatted;
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
	if($sessionUser == "member")
	{
		echo "<br>Membership ID: " . $_SESSION['memberID'] . "<br>";
	}
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
		echo "<a href ='MovieListings.php'>Movie Listings</a>";
		echo "<br>";
		echo "<a href ='CancelReservation.php'>Cancel Reservation</a>";
		echo "<br>";
		echo "<a href ='AddMemberToAccount.php'>Add a Member to your Membership</a>";
		echo "<br>";
		echo "<a href ='RenewMembership.php'>Renew Membership</a>";
		echo "<br>";
		echo "<a href ='ViewMembershipInfo.php'>View Membership Info</a>";
		echo "<br>";
	}
	
	if($_SESSION["userType"] == "employee")
	{
		echo "<a href ='ScheduleMovie.php'>Schedule a movie showing</a>";
	}
	
	
	if($_SESSION["userType"] == "admin")
	{
		echo "<b> Manage Database </b>";
		echo "<br>";		
		echo "<a href ='ReloadDatabase.php'>Reset database with test data</a>";
		echo "<br>";
		echo "<a href ='ResetReservations.php'>Reset all Reservation and Movie Showing data</a>";
		echo "<br>";
		echo "<a href ='ClearSession.php'>Clear session variables</a>";
		echo "<br>";
		echo "<a href ='SetDate.php'>Set today's date</a>";
		echo "<br>";
		
		echo "<br><b> Manage Cinemas </b>";
		echo "<br>";
		echo "<a href ='ShowCinemas.php'>View Cinemas</a>";
		echo "<br>";
		echo "<a href ='AddCinema.php'>Add a Cinema</a>";
		echo "<br>";
		echo "<a href ='DeleteCinema.php'>Delete a Cinema</a>";
		echo "<br>";
		echo "<a href ='UpdateCinema.php'>Update a Cinema</a>";
		echo "<br>";
		
		echo "<br><b> Manage Theaters </b>";
		echo "<br>";
		echo "<a href ='ShowTheaters.php'>View Theaters</a>";
		echo "<br>";
		echo "<a href ='AddTheater.php'>Add a Theater</a>";
		echo "<br>";
		echo "<a href ='DeleteTheater.php'>Delete a Theater</a>";
		echo "<br>";		
		
		echo "<br><b> Manage Movies </b>";
		echo "<br>";
		echo "<a href ='ShowMovies.php'>View Movies</a>";
		echo "<br>";
		echo "<a href ='AddMovie.php'>Add a Movie</a>";
		echo "<br>";
		echo "<a href ='DeleteMovie.php'>Delete a Movie</a>";
		echo "<br>";
		echo "<a href ='UpdateMovie.php'>Update a Movie</a>";
		echo "<br>";
		
		echo "<br><b> Manage Members </b>";
		echo "<br>";
		echo "<a href ='ShowMembers.php'>View Members</a>";
		echo "<br>";
		echo "<a href ='ShowMemberships.php'>View Memberships</a>";
		echo "<br>";		
		echo "<a href ='DeleteMember.php'>Delete a Member</a>";
		echo "<br>";
		echo "<a href ='DeleteMembership.php'>Delete a Membership</a>";
		echo "<br>";
		echo "<a href ='UpdateMember.php'>Update a Member</a>";
		echo "<br>";
		echo "<a href ='UpdateMembership.php'>Update a Membership</a>";
		echo "<br>";

		echo "<br><b> Manage Events </b>";
		echo "<br>";
		echo "<a href ='ShowReservations.php'>View Reservations</a>";
		echo "<br>";
		echo "<a href ='ShowMovieShowings.php'>View Movie Showings</a>";
		echo "<br>";
		echo "<a href ='DeleteReservation.php'>Delete a Reservation</a>";
		echo "<br>";
		echo "<a href ='DeleteMovieShowing.php'>Delete a Movie Showing</a>";
		echo "<br>";		
			
	}
	
	if($_SESSION["userType"] == "guest")
	{
		echo "<br>";
		echo "<a href ='AddMembership.php'>Create Membership Account</a>";
	}
	
	
?>

<br>
<a href ='ViewingHistory.php'>Display Viewing History</a>
<br>
<a href ="LoginPage.php">Login Page</a>
<br>
<br>

</body>
</html>



