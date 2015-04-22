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
Movie Viewing History
</title>
</head>
<h3>Movie Viewing History</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	/*
	if($sessionUser != "member")
	{
		echo 'Not logged in as a member!';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	*/

	echo "Logged in as: $sessionUser"; 
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 
<br>
<br>

<?php 

	// CODE STARTS HERE
	echo "<form action = 'PageToPostDataTo.php' method = 'post'>";
	echo "<select name='member'>";
	echo "<option value='1'>Select member 1</option>";
	echo "<option value='2'>Select member 2</option>";
	echo "<option value='3'>Select member 3</option>";
	echo "<option value='4'>Select member 4</option>";
	echo "<option value='5'>Select member 5</option>";
	echo "<option value='6'>Select member 6</option>";
	echo "</select>";
	echo "<br>";
	echo "<input type ='submit' name = 'Submit Form'>";
	echo "</form>";
	
	
	
?>

</body>
</html>