<?php 
	include "login.php";
?>

<html>


<head>
<title>
Reservation Results
</title>
<head>

<h3>Reservation Results</h3>
<body>

<?php

	if(isset($_POST['row']) && isset($_POST['column']))
	{
		$row = $_POST['row'];
		$column = $_POST['column'];
		echo "You selected a reservation for row: " 
		. $row . " and seat: " 
		. $column;		
	}
?>
