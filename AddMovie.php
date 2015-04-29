<?php
/*|-------------------------------------------------------------------------
 *| CMPS 460 Spring 2015 
 *| Ryan Adair
 *| 4/28/15
 *|
 *| The following code is the work of the author named above.
 *|-----------------------------------------------------------------------
 *| This script generates a webpage with the appropriate fields 
 *| displayed to allow an admin to enter a new movie into the
 *| Movie table of the database.
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
Add A Movie
</title>
</head>

<h3>
Add New Movie 
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

if(isset($_POST['title']) && isset($_POST['stars']) && isset($_POST['description']) && isset($_POST['runtime']) && isset($_POST['rating']))
	{
		$title = $_POST['title'];
		$stars = $_POST['stars'];
		$description = $_POST['description'];
		$runtime = $_POST['runtime'];
		$rating = $_POST['rating'];
		
		$addMovieQuery = "insert into Movie (Title, Stars, Description, RunningTimeMinutes, Rating)
										values ('$title', '$stars', '$description', '$runtime', '$rating')";
		$addMovieResult = mysql_query($addMovieQuery) or die(mysql_error());
		
		echo "Movie successfully added!<br>";
		
	}
	
	else
	{
		
?>

<form action='AddMovie.php' method = 'post'>
  Title: <input type="text" name="title" placeholder="Title..." required><br><br>
  Starring: <br><textarea name="stars" cols=40 rows=4 placeholder="Stars..."></textarea><br><br>
  Description: <br><textarea name="description" cols=60 rows=8 placeholder="Description..."></textarea><br><br>
  Running Time: <input type="number" min="1" step="1" name="runtime" placeholder="90" required> min<br><br>
  Rating: <select name="rating">
	<option value="G">G</option>
	<option value="PG">PG</option>
	<option value="PG13">PG-13</option>
	<option value="R">R</option>
 </select><br>
  <br><input type="submit" value="Add Movie">
</form>
	
<?php	
	
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   

?>

</body>
</html>