<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Update a movie in the database
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
Update Movie
</title>
</head>

<h3>
Update Movie
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

	
	if($sessionUser != "admin")
	{
		echo 'Not logged in as a Admin!';
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

	if(isset($_POST['movieToUpdate']))
	{
		$movieID = $_POST['movieToUpdate'];
		
		$movieGet = "select * from Movie M where M.ID = $movieID";
		$movieResult = mysql_query($movieGet) or die (mysql_error());
		
		if($row = mysql_fetch_array($movieResult))
		{
			$movieTitle = $row['Title'];
			$movieStars = $row['Stars'];
			$movieDescription = $row['Description'];
			$movieRunningTime = $row['RunningTimeMinutes'];
			
			echo "<form action ='ConfirmUpdateMovie.php' method='post'>";
			echo "Title: <input type='text' name='movieTitle' value='$movieTitle' required>";
			echo "<br>";
			echo "Stars: <input type='text' name='movieStars' value='$movieStars' required>";
			echo "<br>";
			echo "Movie Description: <input type='text' name='movieDescription' value='$movieDescription' required>";
			echo "<br>";
			echo "Running time (in minutes): <input type='number' name='movieRunningTime' value='$movieRunningTime' required>";
			echo "<br>";
			
			echo "<input type ='hidden' name ='movieID' value='$movieID'>";
			echo "<br>";
			echo "<input type = 'submit' value = 'Update Movie'>";
			echo "</form>";
		}
	}
	
	else
	{
		$moviesQuery = "select * from Movie";
		$moviesResult = mysql_query($moviesQuery) or die(mysql_error());
		
		echo "<form action ='UpdateMovie.php' method='post'>";
		echo "<select name='movieToUpdate'>";
		
		while($row = mysql_fetch_array($moviesResult))
		{
			$movieID = $row['ID'];
			$movieTitle = $row['Title'];
			echo "<option value= '$movieID' >$movieTitle</option>";
		}
		
		echo "</select>";
		echo "<br><br>";
		echo "<input type = 'submit' value = 'Select movie to edit'>";
		echo "</form>";
	}

  
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";	  
?>

</body>
</html>