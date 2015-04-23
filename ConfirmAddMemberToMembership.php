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
Add Member to Membership Confirmation
</title>
</head>

<h3>
Add Member to Membership Confirmation
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
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 

<br>
<br>

<?php 

	// CODE STARTS HERE
	
	if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['age']))
	{
		$name = $_POST['name'];
		$age= $_POST['age'];
		$phoneNumber = $_POST['phoneNumber'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$memberID = '';
		$memberAcctOrder = '';
		
		$membershipID = $_SESSION['memberID'];
		
		// get count of members already in this account
		$membershipCount = "select count(*) as MemberCount from Member where MemberAcctNum='$membershipID'";
		$membershipCountResult = mysql_query($membershipCount) or die(mysql_error());
		if($row = mysql_fetch_array($membershipCountResult))
		{
			// increment member account order by 1
			$memberAcctOrder = $row['MemberCount'] + 1;
		}
		
		
		
		
		
		
		$memberAddQuery = "insert into Member (MemberAcctNum, MemberAcctOrder, Name, Address, Email, PhoneNumber, Age)
										 values ($membershipID, '$memberAcctOrder','$name', '$address', '$email', '$phoneNumber', '$age')";						 
		$memberResult = mysql_query($memberAddQuery) or die(mysql_error());
		
		
		
		echo "Member added to your account successfully!";
		
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