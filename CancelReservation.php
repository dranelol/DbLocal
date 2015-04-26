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
Cancel Reservation
</title>
</head>

<h3>
Cancel Reservation
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
	$membershipID =  $_SESSION['memberID'];
	// CODE STARTS HERE
	$reservationsQuery = "select R.ID, M.Title, C.Name, S.ShowDate, S.ShowTime, Me.Name as MemberName
										from Reservation R, Movie M, MovieShowing S, Cinema C, Member Me
										where R.MembershipID = '$membershipID'
										and R.MovieShowingID = S.ID
										and S.MovieID = M.ID
										and S.CinemaID = C.ID
										and Me.ID = R.MemberID";
										
	
	
	$reservationsResult = mysql_query($reservationsQuery) or die(mysql_error());
	
	if($reservationsResult)
	{
		if(mysql_num_rows($reservationsResult))
		{
			echo "<form action = 'ConfirmCancelReservation.php' method = 'post'>";
			
			echo "<select name='reservationToCancel'>";
			
			while($row = mysql_fetch_array($reservationsResult))
			{
					$reservationID = $row['ID'];
					$memberName = $row['MemberName'];
					$movieTitle = $row['Title'];
					$cinemaName = $row['Name'];
					$showTime = $row['ShowTime'];
					$showDate = $row['ShowDate'];
					
					$showDateFormatted = explode("-", $showDate );
					$showDateFormatted = date("m/d/Y", mktime(0,0,0, $showDateFormatted[1], $showDateFormatted[2], $showDateFormatted[0]));
					
					echo "<option value='$reservationID'>Reservation for $memberName, seeing $movieTitle, showing at $cinemaName, on $showDateFormatted at $showTime</option>";
			}
			
			echo "</select>";
			echo "<br>";
			echo "<input type='submit' value='Cancel Reservation'>";
			echo "</form>";
		}
		
		else
		{
			echo "No reservations for this account have been made!";
			echo '<br><a href ="index.php">Go to Index</a>';
			die();
		}
	}
	
	else
	{
		echo "Null result!";
		echo '<br><a href ="index.php">Go to Index</a>';
		die();
	}
	
	
			  
	echo '<br><a href ="index.php">Go to Index</a>';	  
?>

</body>
</html>