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
View Movies
</title>
</head>

<h3>
View Movies
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
	
	$movieQuery = mysql_query("select * from Movie;") or die(mysql_error());	

	if(mysql_num_rows($movieQuery))
	{
		echo "<table border = \'1\' cellpadding = \'10\'>";
		echo "<tr> 
				  <th>ID</th> 
				  <th>Title</th> 
				  <th>Stars</th>
				  <th>Duration (minutes)</th>
				  <th>Rating</th>
				  <th>Description</th>
				  </tr>";
		
		while($movieRow = mysql_fetch_array($movieQuery))
		{
				echo "<tr>
				  <td>" . $movieRow['ID'] . "</td> 
				  <td>" . $movieRow['Title'] . "</td>
				  <td>" . $movieRow['Stars'] . "</td>
				  <td>" . $movieRow['RunningTimeMinutes'] . "</td>
				  <td>" . $movieRow['Rating'] . "</td>
				  <td>" . $movieRow['Description'] . "</td>
						 
				</tr>";	
		}
		
			echo "</table><br>";
	}
	
	else
	{
		echo "No movies exist.<br><br>";
	}

	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
?>

</body>
</html>