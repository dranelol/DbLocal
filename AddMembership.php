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
Add Membership
</title>
</head>

<h3>
Add Membership
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
	
	echo "Input the information for the primary member <br>";
	
	echo "<form action='ConfirmAddMembership.php' method = 'post'>
			  Name: 
			  <input type='text' name='name' placeholder='John Doe'>
			  <br>
			  Address: 
			  <input type='text' name='address' placeholder='123 North Easy Street'>
			  <br>
			  Phone Number: 
			  <input type='text' name='phoneNumber' placeholder='123-456-7890'>
			  <br>
			   Email:
			  <input type='text' name='email' placeholder='john@gmail.com'>
			  <br>
			   Age:
			  <input type='text' name='age' placeholder='32'>
			  <br>";
			   
			  
			
	echo "Input the length, in months, for this membership <br>";
	
	echo "Length of membership: 
			  <input type='text' name='length' placeholder='5'>
			  <br>
			<input type='submit' value='Add Membership'>
	</form>";
	
?>

</body>
</html>