<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Update a membership in the database
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
Update Membership
</title>
</head>

<h3>
Update Membership
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

	if(isset($_POST['membershipToUpdate']))
	{
		$membershipID = $_POST['membershipToUpdate'];
		
		$membershipQuery = "select * from Membership M where M.AcctNum = '$membershipID'";
		
		$membershipResult = mysql_query($membershipQuery) or die (mysql_error());
		
		$startDate = '';
		$endDate = '';
		
		if($row = mysql_fetch_array($membershipResult))
		{
			$startDate = $row['StartDate'];
			$endDate = $row['EndDate'];
		}
		
		echo "<form action ='ConfirmUpdateMembership.php' method='post'>";
		
		$membersQuery = "select * from Member M where M.MemberAcctNum = '$membershipID' order by M.MemberAcctOrder";
		$membersResult = mysql_query($membersQuery) or die(mysql_error());
		
		echo "Select new primary member for membership:";
		echo "<select name ='newPrimaryID'>";
		
		while($row = mysql_fetch_array($membersResult))
		{
			$memberID = $row['ID'];
			$memberName = $row['Name'];
			echo "<option value= '$memberID' >$memberName</option>";
		}
		echo "</select>";
		echo "<br>";
		echo "<input type ='date' name ='startDate' value =$startDate>";
		echo "<br>";
		echo "<input type ='date' name ='endDate' value =$endDate>";
		echo "<br>";
		echo "<input type ='hidden' name ='membershipID' value='$membershipID'>";
		echo "<br>";
		echo "<input type = 'submit' value = 'Update Membership'>";
		echo "</form>";
		
	}
	
	else
	{
		$membershipsQuery = "select * from Membership";
		$membershipsResult = mysql_query($membershipsQuery) or die(mysql_error());
		
		echo "<form action ='UpdateMembership.php' method='post'>";
		echo "<select name='membershipToUpdate'>";
		
		while($row = mysql_fetch_array($membershipsResult))
		{
			$membershipID = $row['AcctNum'];
			
			echo "<option value= '$membershipID'>$membershipID</option>";
		}
		
		echo "</select>";
		echo "<br><br>";
		echo "<input type = 'submit' value = 'Select membership to edit'>";
		echo "</form>";
	}

  
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";	  
?>

</body>
</html>