<?php

/*|-------------------------------------------------------------------------
 *| CMPS 460 Spring 2015 
 *| Ryan Adair
 *| 4/28/15
 *|
 *| The following code is the work of the author named above.
 *|-----------------------------------------------------------------------
 *| This script generates a webpage with the appropriate fields 
 *| displayed to allow an admin to delete a movie from the Movie
 *| table in the database.
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
Delete a Movie
</title>
</head>

<h3>
Delete a Movie
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

	if(isset($_POST['movieToDelete']))
	{
		$movieID = $_POST['movieToDelete'];
				
		$deleteMovieQuery = "delete from Movie where ID=$movieID;";								
		if(mysql_query($deleteMovieQuery) or die(mysql_error()))
		{
			echo "Movie successfully deleted!<br>";
		}
		else
		{
			echo "<br>Could not delete movie.";
			echo '<br><a href ="DeleteMovie.php">Go to Delete Movie</a>';			
		}
	}
	else	
	{
		$movieQueryResult = mysql_query("select * from Movie;") or die(mysql_error());	

		if(mysql_num_rows($movieQueryResult))
		{
			echo "<form action='DeleteMovie.php' method='post'>";
			echo "Delete Movie: ";
			echo "<select name='movieToDelete'>";
				
			while($movieRow = mysql_fetch_array($movieQueryResult))
			{
				$movieID = $movieRow['ID'];
				$movieTitle = $movieRow['Title'];
				
				echo "<option value='$movieID'>($movieID) $movieTitle</option>";
			}
			
			echo "</select>";
			echo "<br><br>";
			echo "<input type='submit' value='Delete Movie'>";
			echo "</form>";		
		}
		
		else
		{
			echo "No existing movies.<br>";
		}
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>

</body>
</html>