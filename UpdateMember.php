<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Update a member in the database
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
Update Member
</title>
</head>

<h3>
Update Member
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

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
	if(isset($_POST['memberToUpdate']))
	{
		$memberID = $_POST['memberToUpdate'];
		
		
		$memberGet = "select * from Member M where M.ID = $memberID";
		
		$memberResult = mysql_query($memberGet) or die (mysql_error());
		
		if($row = mysql_fetch_array($memberResult))
		{
			$memberName = $row['Name'];
			$memberAddress = $row['Address'];
			$memberEmail = $row['Email'];
			$memberPhoneNumber = $row['PhoneNumber'];
			
			echo "<form action ='ConfirmUpdateMember.php' method='post'>";
			echo "Name: <input type='text' name='memberName' value='$memberName' required>";
			echo "<br>";
			echo "Address: <input type='text' name='memberAddress' value='$memberAddress' required>";
			echo "<br>";
			echo "Phone Number: <input type='tel' name='memberPhoneNumber' value='$memberPhoneNumber' required>";
			echo "<br>";
			echo "Email: <input type='email' name='memberEmail' value='$memberEmail' required>";
			echo "<br>";
			echo "<input type ='hidden' name ='memberID' value='$memberID'>";
			echo "<br>";
			echo "<input type = 'submit' value = 'Update Member'>";
			echo "</form>";
		}
	}
	
	else
	{
		$membersQuery = "select * from Member";
		$membersResult = mysql_query($membersQuery) or die(mysql_error());
		
		echo "<form action ='UpdateMember.php' method='post'>";
		echo "<select name='memberToUpdate'>";
		
		while($row = mysql_fetch_array($membersResult))
		{
			$memberID = $row['ID'];
			$memberName = $row['Name'];
			$memberAddress = $row['Address'];
			echo "<option value= '$memberID' >$memberName</option>";
		}
		
		echo "</select>";
		echo "<br><br>";
		echo "<input type = 'submit' value = 'Select member to edit'>";
		echo "</form>";
	}
			  
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";	  
?>

</body>
</html>