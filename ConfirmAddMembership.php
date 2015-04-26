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
Confirm Membership Add
</title>
</head>

<h3>
Confirm Membership Add
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
	
	if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['age']) && isset($_POST['length']))
	{
		$name = $_POST['name'];
		$age= $_POST['age'];
		$phoneNumber = $_POST['phoneNumber'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$memberID = '';
		$membershipID = '';
		$length = $_POST['length'];
		$today = explode("/", $date);
		
		$startDate = date("Y-m-d", mktime(0,0,0, $today[2], $today[1], $today[0]));
		$endDate = date("Y-m-d", mktime(0,0,0, $today[2], $today[1] + $length, $today[0]));
		
		//die();
		// create member first
		
		$memberAddQuery = "insert into Member (MemberAcctNum, MemberAcctOrder, Name, Address, Email, PhoneNumber, Age)
										 values (NULL, '1','$name', '$address', '$email', '$phoneNumber', '$age')";						 
		$memberResult = mysql_query($memberAddQuery) or die(mysql_error());
		
		// get the new ID for this member
		$memberIDQuery = "select ID from Member order by ID desc limit 1";
		$IDResult = mysql_query($memberIDQuery) or die (mysql_error());
		if($row = mysql_fetch_array($IDResult))
		{
			$memberID = $row['ID'];
		}
				
		// create a new membership for this member
		
		$membershipAddQuery =  "insert into Membership (PrimaryMemberID, StartDate, EndDate)
												values ('$memberID', '$startDate', '$endDate')";
		
		$membershipResult = mysql_query($membershipAddQuery) or die(mysql_error());
		
		// get the membership ID for this membership
		$membershipIDQuery = "select AcctNum from Membership order by AcctNum desc limit 1";
		$membershipIDResult = mysql_query($membershipIDQuery) or die (mysql_error());
		if($row = mysql_fetch_array($membershipIDResult))
		{
			$membershipID = $row['AcctNum'];
		}
		
		$memberUpdateQuery = "update Member
												set MemberAcctNum = '$membershipID'
												where ID = '$memberID'";
		$memberUpdateResult = mysql_query($memberUpdateQuery) or die (mysql_error());
		
		echo "Membership created!";
		echo "<br>";
		echo "Your membership ID is: $membershipID";
		
		
		echo '<br><a href ="index.php">Go to Index</a>';
	}
	
	else
	{
		echo "Got here illegally!";
		echo '<br><a href ="index.php">Go to Index</a>';
	}
	
?>

</body>
</html>