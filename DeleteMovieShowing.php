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
Delete a Movie Showing
</title>
</head>

<h3>
Delete a MovieShowing
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

	if(isset($_POST['showingToDelete']))
	{
		$showingID = $_POST['showingToDelete'];
		
		$deleteShowingQuery = "delete from MovieShowing where ID=$showingID";

	
		if(mysql_query($deleteShowingQuery) or die(mysql_error()))
		{
			echo "Movie showing $showingID has been canceled.<br>";
		}
				
		else
		{
			echo "<br>Could not delete movie showing.";
			echo '<br><a href ="DeleteMovieShowing.php">Go Back</a>';			
		}	
	}
		
	else	
	{
		$showingQueryResult = mysql_query("select * from MovieShowing order by CinemaID, MovieID, ShowDate, ShowTime;") or die(mysql_error());	

		if(mysql_num_rows($showingQueryResult))
		{
			echo "<form action='DeleteMovieShowing.php' method='post'>";
			echo "Delete Movie Showing: ";
			echo "<select name='showingToDelete'>";
			
			while($showingRow = mysql_fetch_array($showingQueryResult))
			{
					$showingID = $showingRow['ID'];
					$movieID = $showingRow['MovieID'];
					$cinemaID = $showingRow['CinemaID'];
					$date = $showingRow['ShowDate'];
					$time = $showingRow['ShowTime'];
					
					$titleQuery = mysql_fetch_array(mysql_query("Select Title from Movie where ID=$movieID;"));
					$title = $titleQuery['Title'];
					$cinemaQuery = mysql_fetch_array(mysql_query("Select Name from Cinema where ID=$cinemaID;"));
					$cinemaName = $cinemaQuery['Name'];
					
					echo "<option value='$showingID'>($showingID) \"$title\" at $cinemaName on $date $time</option>";
			}
			
			echo "</select>";
			echo "<br><br>";
			echo "<input type='submit' value='Delete Movie Showing'>";
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