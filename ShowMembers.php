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
View Members
</title>
</head>

<h3>
View Members
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
	
	$memberQuery = mysql_query("select * from Member order by MemberAcctNum, MemberAcctOrder;") or die(mysql_error());	

	if(mysql_num_rows($memberQuery))
	{
		echo "<table border = \'1\' cellpadding = \'10\'>";
		echo "<tr> 
				  <th>Account Number</th> 
				  <th>ID</th> 
				  <th>Name</th> 
				  <th>Address</th>
				  <th>Email</th>
				  <th>Phone Number</th>
				  <th>Age</th>
				  </tr>";
		
		while($memberRow = mysql_fetch_array($memberQuery))
		{
				echo "<tr>
					<td>" . $memberRow['MemberAcctNum'] . "</td>
					<td>" . $memberRow['ID'] . "</td>
					<td>" . $memberRow['Name'] . "</td>
					<td>" . $memberRow['Address'] . "</td>
					<td>" . $memberRow['Email'] . "</td>
					<td>" . $memberRow['PhoneNumber'] . "</td>
					<td>" . $memberRow['Age'] . "</td>
				</tr>";	
		}
		
			echo "</table><br>";
	}
	
	else
	{
		echo "No members exist.<br><br>";
	}

	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
?>

</body>
</html>