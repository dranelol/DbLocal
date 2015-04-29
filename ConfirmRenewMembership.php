<?php

// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for renewing a membership.


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
Confirm Renew Membership
</title>
</head>

<h3>
Confirm Renew Membership
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

	
	if($sessionUser != "member")
	{
		echo 'Not logged in as a member!';
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

	if(isset($_POST['length']) && isset($_POST['startDate']))
	{
		$length = $_POST['length'];
		
		if($length <1)
		{
			echo "Need to specify a number of months greater than 0!";
			echo '<br><a href ="index.php">Go to Index</a>';
			die();
		}
		
		
		$startDate = $_POST['startDate'];
		
		$startDateArr = explode("-", $startDate);
		$newMonth = $startDateArr[1] + $length;
		
		$newEndDate = date("Y-m-d", strtotime($startDateArr[0] . '-' . $newMonth . '-' . $startDateArr[2]));
		
		$membershipID = $_SESSION['memberID'];
		
		//echo $startDate . "<br>" . $newEndDate;
		
		//die();
		if($newEndDate < $startDate)
		{
			echo "You specified an end date that ends prior to the start date! (today, if renewing membership)";
			echo '<br><a href ="index.php">Go to Index</a>';
			die();
		}
		
		else
		{
			$updateMembershipQuery = "update Membership 
														set StartDate = '$startDate', EndDate = '$newEndDate'
														where AcctNum = '$membershipID'";
			$updateMembershipResult = mysql_query($updateMembershipQuery) or die(mysql_error());
			
			echo "Membership updated!";
			
			echo "<br>";
			echo "<form action ='index.php'>";
			echo "<input type ='submit' value = 'Go back to index' >";  
			echo "</form>";   
		}
		
			
	}
	
	else
	{
		
		echo "Got here illegally!";
		echo "<br>";
		echo "<form action ='index.php'>";
		echo "<input type ='submit' value = 'Go back to index' >";  
		echo "</form>";   
	}
	
			  
	  
?>

</body>
</html>