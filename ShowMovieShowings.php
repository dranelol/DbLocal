<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Show all cinemas
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
View Movie Showings
</title>
</head>

<h3>
View Movie Showings
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	
	
	if($sessionUser != "admin")
	{
		echo 'Not logged in as an admin!';
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
	
	$cinemaQuery = mysql_query("select * from Cinema;") or die(mysql_error());	

	if(mysql_num_rows($cinemaQuery))
	{
		while($cinemaRow = mysql_fetch_array($cinemaQuery))
		{
			$cinemaID = $cinemaRow['ID'];
			$cinemaName = $cinemaRow['Name'];
			$showQuery = mysql_query("select * from MovieShowing where CinemaID=$cinemaID;") or die(mysql_error());
			
			if(mysql_num_rows($showQuery))
			{
				echo "<b>$cinemaName</b>";
				echo "<table border = \'1\' cellpadding = \'10\'>";
				echo "<tr> 
						  <th>ID</th> 
						  <th>Theater Number</th> 
						  <th>Movie Title</th>
						  <th>Date</th>
						  <th>Time</th>
						  <th>Available Seats</th>
						  </tr>";
		
				while($showRow = mysql_fetch_array($showQuery))
				{
						$theaterID = $showRow['TheaterID'];
						$theaterNumber = mysql_fetch_array(mysql_query("select TheaterNumber from Theater where ID=$theaterID;"))['TheaterNumber'];
						
						$movieID = $showRow['MovieID'];
						$movieTitle = mysql_fetch_array(mysql_query("select Title from Movie where ID=$movieID;"))['Title'];
						
						echo "<tr>
						  <td>" . $showRow['ID'] . "</td> 
						  <td>" . $theaterNumber . "</td>
						  <td>" . $movieTitle . "</td>
						  <td>" . $showRow['ShowDate'] . "</td>
						  <td>" . $showRow['ShowTime'] . "</td>
						  <td>" . $showRow['SeatsAvailable'] . "</td>
						</tr>";	
				}
		
				echo "</table><br>";		
			}
		}
	}
	
	else
	{
		echo "No movie showings exist.<br><br>";
	}

	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
?>

</body>
</html>