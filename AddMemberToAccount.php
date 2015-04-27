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
Add Member to Membership 
</title>
</head>

<h3>
Add Member to Membership
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
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 

<br>
<br>

<?php 

	// CODE STARTS HERE
	$membershipID = $_SESSION['memberID'];
	
	echo "Input the information for the member you want to add<br>";
	
	echo "<form action='ConfirmAddMemberToMembership.php' method = 'post'>
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
			  <br>
	
			<input type='submit' value='Add Member to Account'>
			</form>";
			
	
			
	
	
?>
<form action = 'index.php'>
    <?php        
        echo"<input type ='submit' value = 'Go back to index' >";    
    ?>  
</body>
</html>