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

	if(isset($_POST['row']) && isset($_POST['column']) && isset($_POST['showingID']))
	{
		
		$row = $_POST['row'];
		$column = $_POST['column'];
		$showingID = $_POST['showingID'];
		$memberID = $_SESSION['memberID'];
		echo "You selected a reservation for row: " 
		. $row . " and seat: " 
		. $column;
		
		echo "<form action = 'ConfirmSeatReservation.php' method = 'post'>";
		echo "<input type ='hidden' value = $row name ='row'>";
		echo "<input type ='hidden' value = $showingID name ='showingID'>";
		echo "<input type ='hidden' value = $column name ='column'>";
		echo "<input type='submit' value='Confirm Seat Reservation'>";
		
		echo "</form>";
	}
?>

</body>
</html>