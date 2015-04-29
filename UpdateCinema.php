<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Update a cinema in the database
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
Update Cinema
</title>
</head>

<h3>
Update Cinema
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

	if(isset($_POST['cinemaToUpdate']))
	{
		$cinemaID = $_POST['cinemaToUpdate'];
		
		$cinemaGet = "select * from Cinema C where C.ID = $cinemaID";
		$cinemaResult = mysql_query($cinemaGet) or die (mysql_error());
		
		if($row = mysql_fetch_array($cinemaResult))
		{
			$cinemaName = $row['Name'];
			$cinemaAddress = $row['Address'];
			$cinemaPhoneNumber = $row['PhoneNumber'];
			
			echo "<form action ='ConfirmUpdateCinema.php' method='post'>";
			echo "Name: <input type='text' name='cinemaName' value='$cinemaName' required>";
			echo "<br>";
			echo "Address: <input type='text' name='cinemaAddress' value='$cinemaAddress' required>";
			echo "<br>";
			echo "Phone Number: <input type='tel' name='cinemaPhoneNumber' value='$cinemaPhoneNumber' required>";
			echo "<br>";
			echo "<input type ='hidden' name ='cinemaID' value='$cinemaID'>";
			echo "<br>";
			echo "<input type = 'submit' value = 'Update Cinema'>";
			echo "</form>";
		}
	}
	
	else
	{
		$cinemasQuery = "select * from Cinema";
		$cinemasResult = mysql_query($cinemasQuery) or die(mysql_error());
		
		echo "<form action ='UpdateCinema.php' method='post'>";
		echo "<select name='cinemaToUpdate'>";
		
		while($row = mysql_fetch_array($cinemasResult))
		{
			$cinemaID = $row['ID'];
			$cinemaName = $row['Name'];
			$cinemaAddress = $row['Address'];
			echo "<option value= '$cinemaID' >$cinemaName, $cinemaAddress</option>";
		}
		
		echo "</select>";
		echo "<br><br>";
		echo "<input type = 'submit' value = 'Select cinema to edit'>";
		echo "</form>";
	}

  
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";	  
?>

</body>
</html>