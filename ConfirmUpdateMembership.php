<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for update membership
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
Update Membership Confirmation
</title>
</head>

<h3>
Update Membership Confirmation
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
	if(isset($_POST['membershipID']) && isset($_POST['newPrimaryID']) && isset($_POST['startDate']) && isset($_POST['endDate']))
	{
		$membershipID = $_POST['membershipID'];
		$newPrimaryMemberID = $_POST['newPrimaryID'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		
		
		
		$membershipUpdate = "update Membership set PrimaryMemberID = '$newPrimaryMemberID', StartDate = '$startDate', EndDate = '$endDate' where AcctNum = '$membershipID'";
		$membershipResult = mysql_query($membershipUpdate) or die(mysql_error());
		
		echo "Membership successfully updated!";
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