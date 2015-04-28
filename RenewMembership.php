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
Renew Membership
</title>
</head>

<h3>
Renew Membership
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

	$membershipID = $_SESSION['memberID'];
	
	$today = explode("/", $date);
		
	$todayFormat = date("Y-m-d", mktime(0,0,0, $today[0], $today[1], $today[2]));
	//$startDate = date("Y-m-d", mktime(0,0,0, $today[2], $today[1], $today[0]));
	//$endDate = date("Y-m-d", mktime(0,0,0, $today[2], $today[1] + $length, $today[0]));
	
	$getDatesQuery = "select M.StartDate, M.EndDate from Membership M where M.AcctNum = $membershipID";
	
	$getDatesResult = mysql_query($getDatesQuery) or die(mysql_error());
	
	if($row = mysql_fetch_array($getDatesResult))
	{
		$startDate = $row['StartDate'];
		
		$endDate = $row['EndDate'];
		
		//echo "Today: " . $todayFormat . "<br>";
		
		echo "Start date for your membership: " . $startDate . "<br>
		          End date for your membership: " . $endDate . "<br>";
		
		echo "<br>";
		echo "<form action='ConfirmRenewMembership.php' method = 'post'>";
		if($endDate > $todayFormat)
		{
			echo "You still have time left on your membership.<br>";
			echo "<input type ='hidden' name='startDate' value ='$startDate'>";
		}
		
		else
		{
			echo "Your membership has expired.<br>"; 
			echo "<input type ='hidden' name='startDate' value ='$todayFormat'>";
		}
		
		echo "<br>";
		
		echo "Add months to membership (start date will be today, if renewing): <br>";
		
		echo "<input type='number' name='length' required>
				 <br>
			  	 <input type='submit' value='Renew Membership'>
			 	 </form>";
	}
	
	
			  
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";     
?>

</body>
</html>