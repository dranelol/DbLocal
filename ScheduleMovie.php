<?php

/*|-------------------------------------------------------------------------
 *| CMPS 460 Spring 2015 
 *| Ryan Adair
 *| 4/28/15
 *|
 *| The following code is the work of the author named above.
 *|-----------------------------------------------------------------------
 *| This script generates a webpage with the appropriate fields 
 *| displayed to allow an admin or employee to schedule a new
 *| movie showing for a specified cinema and theater.
 *|-----------------------------------------------------------------------*/

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
Schedule Movie 
</title>
</head>

<h3>
Schedule Movie Showing
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	if($sessionUser != 'employee' && $sessionUser != "admin")
	{
		echo 'You do not have permission to access this page.';
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
	echo "<br>";

	echo "<form action='ScheduleMovieConfirmation.php' method='post'>";
	// Cinema Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Complex ";
	echo "<select name='complex_select_menu'>";
	$complexQuery = "select ID, Name from Cinema";
	$complexResult = mysql_query($complexQuery) or die(mysql_error());
		
	while($row = mysql_fetch_array($complexResult))
	{
			$cinemaID = $row['ID'];
			$cinemaName = $row['Name'];
			
			echo "<option value='$cinemaID'>$cinemaName</option>";
	}
	
	echo "</select>";
	echo "<br>";
	
	
	// Movie Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Movie ";
	echo "<select name='movie_select_menu'>";
	$movieQuery = "select distinct ID, Title from Movie";
	$movieResult = mysql_query($movieQuery) or die(mysql_error());
	
	while($row = mysql_fetch_array($movieResult))
	{
			$movieID = $row['ID'];
			$movieName = $row['Title'];
			
			echo "<option value='$movieID'>$movieName</option>";
	}
	
	echo "</select>";
	echo "<br>";
	
	
	// Theater Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Theater Number: <input type='text' name='theaterNumber' required>";
	echo "<br>";
	
	// Date Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Date: ";
	echo "<select name='date_select_menu'>"; 
	echo "<option value='2015-01-01'>Today 1/1/2015</option>";
	echo "<option value='2015-01-02'>Friday 1/2/2015</option>";
	echo "<option value='2015-01-03'>Saturday 1/3/2015</option>";
	echo "<option value='2015-01-04'>Sunday 1/4/2015</option>";
	echo "<option value='2015-01-05'>Monday 1/5/2015</option>";
	echo "<option value='2015-01-06'>Tuesday 1/6/2015</option>";
	echo "<option value='2015-01-07'>Wednesday 1/7/2015</option>";
	echo "</select>";
	echo "<br>";	

	// Time Selection Menu
	// ---------------------------------------------------------------------	
	echo "<br>";
	echo "Time: ";
	echo "<select name='time_select_menu'>"; 	
	echo "<option value='00:00:00'>12:00 AM</option>";
	echo "<option value='00:30:00'>12:30 AM</option>";
	
	echo "<option value='01:00:00'>01:00 AM</option>";
	echo "<option value='01:30:00'>01:30 AM</option>";
	
	echo "<option value='02:00:00'>02:00 AM</option>";
	echo "<option value='02:30:00'>02:30 AM</option>";	

	echo "<option value='03:00:00'>03:00 AM</option>";
	echo "<option value='03:30:00'>03:30 AM</option>";	
	
	echo "<option value='04:00:00'>04:00 AM</option>";
	echo "<option value='04:30:00'>04:30 AM</option>";	
	
	echo "<option value='05:00:00'>05:00 AM</option>";
	echo "<option value='05:30:00'>05:30 AM</option>";	
	
	echo "<option value='06:00:00'>06:00 AM</option>";
	echo "<option value='06:30:00'>06:30 AM</option>";	
	
	echo "<option value='07:00:00'>07:00 AM</option>";
	echo "<option value='07:30:00'>07:30 AM</option>";

	echo "<option value='08:00:00'>08:00 AM</option>";
	echo "<option value='08:30:00'>08:30 AM</option>";	
	
	echo "<option value='09:00:00'>09:00 AM</option>";
	echo "<option value='09:30:00'>09:30 AM</option>";	
	
	echo "<option value='10:00:00'>10:00 AM</option>";
	echo "<option value='10:30:00'>10:30 AM</option>";	
	
	echo "<option value='11:00:00'>11:00 AM</option>";
	echo "<option value='11:30:00'>11:30 AM</option>";
	


	echo "<option value='12:00:00'>12:00 PM</option>";
	echo "<option value='12:30:00'>12:30 PM</option>";
	
	echo "<option value='13:00:00'>01:00 PM</option>";
	echo "<option value='13:30:00'>01:30 PM</option>";
	
	echo "<option value='14:00:00'>02:00 PM</option>";
	echo "<option value='14:30:00'>02:30 AM</option>";	

	echo "<option value='15:00:00'>03:00 PM</option>";
	echo "<option value='15:30:00'>03:30 PM</option>";	
	
	echo "<option value='16:00:00'>04:00 PM</option>";
	echo "<option value='16:30:00'>04:30 PM</option>";	
	
	echo "<option value='17:00:00'>05:00 PM</option>";
	echo "<option value='17:30:00'>05:30 PM</option>";	
	
	echo "<option value='18:00:00'>06:00 PM</option>";
	echo "<option value='18:30:00'>06:30 PM</option>";	
	
	echo "<option value='19:00:00'>07:00 PM</option>";
	echo "<option value='19:30:00'>07:30 PM</option>";

	echo "<option value='20:00:00'>08:00 PM</option>";
	echo "<option value='20:30:00'>08:30 PM</option>";	
	
	echo "<option value='21:00:00'>09:00 PM</option>";
	echo "<option value='21:30:00'>09:30 PM</option>";	
	
	echo "<option value='22:00:00'>10:00 PM</option>";
	echo "<option value='22:30:00'>10:30 PM</option>";	
	
	echo "<option value='23:00:00'>11:00 PM</option>";
	echo "<option value='23:30:00'>11:30 PM</option>";	
	
	echo "</select>";	
	echo "<br><br>";
	
	echo "<input type='submit' value='Submit'/>";
	
	echo "</form>";
	
?> 
<form action = 'index.php'>
    <?php        
        echo"<input type ='submit' value = 'Go back to index' >";    
    ?>  
</body>
</html>
