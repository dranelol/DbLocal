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
View Reservations
</title>
</head>

<h3>
View Reservations
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
	
	$resQuery = mysql_query("select * from Reservation order by MembershipID, MemberID, MovieShowingID;") or die(mysql_error());	

	if(mysql_num_rows($resQuery))
	{
		echo "<table border = \'1\' cellpadding = \'10\'>";
		echo "<tr> 
				  <th>ID</th> 
				  <th>Member ID</th> 
				  <th>Cinema Complex</th> 
				  <th>Theater Number</th> 
				  <th>Movie Title</th>
				  <th>Date</th>
				  <th>Time</th>
				  </tr>";
					  
		while($resRow = mysql_fetch_array($resQuery))
		{
			$showingID = $resRow['MovieShowingID'];
			$showRow = mysql_fetch_array(mysql_query("select * from MovieShowing where ID=$showingID;"));

			$cinemaID = $showRow['CinemaID'];
			$cinemaName =  mysql_fetch_array(mysql_query("select Name from Cinema where ID=$cinemaID;"))['Name'];

			$theaterID = $showRow['TheaterID'];
			$theaterNumber = mysql_fetch_array(mysql_query("select TheaterNumber from Theater where ID=$theaterID;"))['TheaterNumber'];
			
			$movieID = $showRow['MovieID'];
			$movieTitle = mysql_fetch_array(mysql_query("select Title from Movie where ID=$movieID;"))['Title'];
			
			echo "<tr>
			  <td>" . $resRow['ID'] . "</td> 
			  <td>" . $resRow['MemberID'] . "</td> 
			  <td>" . $cinemaName . "</td>
			  <td>" . $theaterNumber . "</td>
			  <td>" . $movieTitle . "</td>
			  <td>" . $showRow['ShowDate'] . "</td>
			  <td>" . $showRow['ShowTime'] . "</td>
			</tr>";	
		}
		
		echo "</table><br>";		
			
	}
	
	else
	{
		echo "No reservations exist.<br><br>";
	}

	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
?>

</body>
</html>