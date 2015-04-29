<?php

/*|-------------------------------------------------------------------------
 *| CMPS 460 Spring 2015 
 *| Ryan Adair
 *| 4/28/15
 *|
 *| The following code is the work of the author named above.
 *|-----------------------------------------------------------------------
 *| This script generates a webpage with the appropriate fields 
 *| displayed to allow an admin to delete a theater from the 
 *| Theater table in the database.
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
Delete a Theater
</title>
</head>

<h3>
Delete a Theater
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

	if(isset($_POST['theaterToDelete']))
	{
		$theaterID = $_POST['theaterToDelete'];
				
		$deleteTheaterQuery = "delete from Theater where ID=$theaterID;";						
		if(mysql_query($deleteTheaterQuery) or die(mysql_error()))
		{
			echo "Theater $theaterID successfully deleted!";
		}
		else
		{
			echo "Theater could not be deleted.";
			echo '<br><a href ="DeleteTheater.php">Go Back</a>';				
		}
		
	}
	
	else	
	{
		$theatersExistResult = mysql_query("select * from Theater order by CinemaID,TheaterNumber;") or die(mysql_error());	

		if(mysql_num_rows($theatersExistResult))
		{
			echo "<form action='DeleteTheater.php' method='post'>";
			echo "Delete Theater: ";
			echo "<select name='theaterToDelete'>";
			
			while($theaterRow = mysql_fetch_array($theatersExistResult))
			{
					$theaterID = $theaterRow['ID'];
					$cinemaID = $theaterRow['CinemaID'];
					$theaterNumber = $theaterRow['TheaterNumber'];
					
					$cinemaQuery = mysql_fetch_array(mysql_query("Select Name from Cinema where ID=$cinemaID;"));
					$cinemaName = $cinemaQuery['Name'];
					
					
					echo "<option value='$theaterID'>($cinemaName) $theaterNumber</option>";
			}
			
			echo "</select>";
			echo "<br><br>";
			echo "<input type='submit' value='Delete Theater'>";
			echo "</form>";
		}
		
		else
		{
			echo "No existing theaters.<br>";
		}
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>

</body>
</html>