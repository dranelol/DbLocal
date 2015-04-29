<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Confirmation page for update member
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
Update Member Confirmation
</title>
</head>

<h3>
Update Member Confirmation
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
	if(isset($_POST['memberID']) && isset($_POST['memberName']) && isset($_POST['memberAddress']) && isset($_POST['memberPhoneNumber']) && isset($_POST['memberEmail']))
	{
		$memberID = $_POST['memberID'];
		$memberName = $_POST['memberName'];
		$memberAddress = $_POST['memberAddress'];
		$memberPhoneNumber = $_POST['memberPhoneNumber'];
		$memberEmail = $_POST['memberEmail'];
		
		$memberUpdate = "update Member set Name = '$memberName', Address = '$memberAddress', PhoneNumber = '$memberPhoneNumber', Email = '$memberEmail' where ID = '$memberID'";
		$memberResult = mysql_query($memberUpdate) or die(mysql_error());
		
		echo "Member successfully updated!";
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