<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for update movie
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
Update Movie Confirmation
</title>
</head>

<h3>
Update Movie Confirmation
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

	
	if($sessionUser != "admin")
	{
		echo 'Not logged in as a admin!';
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

	// CODE STARTS HERE
	if(isset($_POST['movieID']) && isset($_POST['movieTitle']) && isset($_POST['movieStars']) && isset($_POST['movieDescription']) && isset($_POST['movieRunningTime']))
	{
		$movieID = $_POST['movieID'];
		$movieTitle = $_POST['movieTitle'];
		$movieStars= $_POST['movieStars'];
		$movieDescription = $_POST['movieDescription'];
		$movieRunningTime = $_POST['movieRunningTime'];
		
		$movieUpdate = "update Movie set Title = '$movieTitle', Stars = '$movieStars', Description = '$movieDescription', RunningTimeMinutes = '$movieRunningTime' where ID = '$movieID'";
		$movieResult = mysql_query($movieUpdate) or die(mysql_error());
		
		echo "Movie successfully updated!";
	}
	
	else
	{
		echo "Got here illegally!";
		
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";	  
	  
?>

</body>
</html>