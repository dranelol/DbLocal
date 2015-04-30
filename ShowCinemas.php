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
View Cinemas
</title>
</head>

<h3>
View Cinemas
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
	
	$cinemaQuery = mysql_query("select * from Cinema;") or die(mysql_error());	

	if(mysql_num_rows($cinemaQuery))
	{
		echo "<table border = \'1\' cellpadding = \'10\'>";
		echo "<tr> 
				  <th>ID</th> 
				  <th>Name</th> 
				  <th>Address</th>
				  <th>Phone Number</th>
				  </tr>";
		
		while($cinemaRow = mysql_fetch_array($cinemaQuery))
		{
				echo "<tr>
				  <td>" . $cinemaRow['ID'] . "</td> 
				  <td>" . $cinemaRow['Name'] . "</td>
				  <td>" . $cinemaRow['Address'] . "</td>
				  <td>" . $cinemaRow['PhoneNumber'] . "</td>
				</tr>";	
		}
		
			echo "</table><br>";
	}
	
	else
	{
		echo "No cinemas exist.<br><br>";
	}

	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
?>

</body>
</html>