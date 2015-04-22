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
Reserve a Seat
</title>
</head>

<h3>Reserve a Seat</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
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
	
	
	if(isset($_POST['row']) && isset($_POST['column']) && isset($_POST['showingID']) && isset($_POST['memberID']) && isset($_POST['memberName']))
	{
		$row = $_POST['row'];
		$column = $_POST['column'];
		$showingID = $_POST['showingID'];
		$membershipID = $_SESSION['memberID'];
		$member = $_POST['memberID'];
		$memberName = $_POST['memberName'];
		
		$memberCountQuery = "select count(*) as mCount from Member M where M.MemberAcctNum='$membershipID'";
		$memberCountResult = mysql_query($memberCountQuery) or die(mysql_error());
		
		$memberCountReservationsQuery = "select count(*) as rCount from Reservation R where R.MemberID='$membershipID'";
		$memberCountReservationsResult = mysql_query($memberCountReservationsQuery) or die(mysql_error());
		
		$row1 = mysql_fetch_array($memberCountResult);
		$membersCount = $row1['mCount'];
		
		$row2 = mysql_fetch_array($memberCountReservationsResult);
		$reservationsCount = $row2['rCount'];
		
		if($reservationsCount < $membersCount)
		{
			echo "You selected a reservation for "
			. $memberName . " on row: " 
			. $row . " and seat: " 
			. $column;
			
			echo "<form action = 'ConfirmSeatReservation.php' method = 'post'>";
			echo "<input type ='hidden' value = $row name ='row'>";
			echo "<input type ='hidden' value = $showingID name ='showingID'>";
			echo "<input type ='hidden' value = $column name ='column'>";
			echo "<input type='submit' value='Confirm Seat Reservation'>";
			
			echo "</form>";
		}
		
		else
		{
			echo '<br>Too many reservations for this showing have been made for your account!';
			echo '<br><a href ="index.php">Go to Index</a>';
		}
		
		
		
		
		
		
		
		
		
		
		
	}
	
	else
	{
		echo '<br>Got here illegally!';
		echo '<br><a href ="index.php">Go to Index</a>';
	}
?>

</body>
</html>