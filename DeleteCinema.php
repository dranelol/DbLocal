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
Delete a Cinema
</title>
</head>

<h3>
Delete a Cinema
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

	if(isset($_POST['cinemaToDelete']))
	{
		$cinemaID = $_POST['cinemaToDelete'];
				
		$deleteCinemaQuery = "delete from Cinema where ID=$cinemaID;";								
		if(mysql_query($deleteCinemaQuery) or die(mysql_error()))
		{
			echo "Cinema $cinemaID successfully deleted!";
		}
		else
		{
			echo "Cinema could not be deleted.";
			echo '<br><a href ="DeleteCinema.php">Go Back</a>';				
		}
		
	}
	else	
	{
		$cinemasExistResult = mysql_query("select * from Cinema;") or die(mysql_error());	

		if(mysql_num_rows($cinemasExistResult))
		{
			if(mysql_fetch_array($cinemasExistResult))
			{		
				echo "<form action='DeleteCinema.php' method='post'>";
				echo "Delete Cinema: ";
				echo "<select name='cinemaToDelete'>";
				
				$selectCinemaResult = mysql_query("select * from Cinema;") or die(mysql_error());	
				while($cinemaRow = mysql_fetch_array($selectCinemaResult))
				{
						$cinemaID = $cinemaRow['ID'];
						$cinemaName = $cinemaRow['Name'];
						$cinemaAddress = $cinemaRow['Address'];
						
						echo "<option value='$cinemaID'>($cinemaID) $cinemaName, $cinemaAddress</option>";
				}
				
				echo "</select>";
				echo "<br><br>";
				echo "<input type='submit' value='Delete Cinema'>";
				echo "</form>";
			}
		}
		
		else
		{
			echo "No existing cinemas.<br>";
		}
	}
	
	echo '<br><a href ="index.php">Go to Index</a>';
?>

</body>
</html>