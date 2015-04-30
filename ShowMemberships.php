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
View Memberships
</title>
</head>

<h3>
View Memberships
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
	
	$memberQuery = mysql_query("select * from Membership;") or die(mysql_error());	

	if(mysql_num_rows($memberQuery))
	{
		echo "<table border = \'1\' cellpadding = \'10\'>";
		echo "<tr> 
				  <th>Account Number</th> 
				  <th>Primary Member ID</th> 
				  <th>Primary Member Name</th> 
				  <th>Start Date</th>
				  <th>End Date</th>
				  </tr>";
		
		while($memberRow = mysql_fetch_array($memberQuery))
		{
				$primaryMemberAcctNum = $memberRow['PrimaryMemberID'];
				$memberName = mysql_fetch_array(mysql_query("select Name from Member where ID=$primaryMemberAcctNum;"))['Name'];
				
				echo "<tr>
					<td>" . $memberRow['AcctNum'] . "</td>
					<td>" . $memberRow['PrimaryMemberID'] . "</td>
					<td>" . $memberName . "</td>
					<td>" . $memberRow['StartDate'] . "</td>
					<td>" . $memberRow['EndDate'] . "</td>
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