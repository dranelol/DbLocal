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
Reservations for Movie Showing
</title>
</head>

<h3>Reservations for Movie Showing</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];

	echo "Logged in as: $sessionUser"; 
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 
<br>
<br>

<form action = "index.php" method = "post">

<?php 

	if(isset($_POST['member']))
	{
		$userType = $_POST['member'];
		
		if($userType = 'member')
		{
			echo "Select your member ID<br>";
			
			echo "<select name='memberID'>";
			
			$membersQuery = "select AcctNum from Membership";
			
			$membersResult = mysql_query($membersQuery) or die(mysql_error());
			
			while($row = mysql_fetch_array($membersResult))
			{
				$memberID = $row['AcctNum'];
				
				echo "<option value='$memberID'>$memberID</option>";
			}
			
			
			
					  //<option value="member">Member</option>
			echo "</select>";
			echo "<br>";
			echo "<input type ='hidden' value = 'member' name ='userType'>";
			echo "<input type='submit' value='Login'></form>";

			
			echo "<br>";
			
		}
	}
	
	else
{
	echo '<br>Got here illegally!';
	echo '<br><a href ="LoginPage.php">Go to Login Page</a>';
}
?>

</form>

</body>
</html>