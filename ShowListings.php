<?php
	include "login.php";

	if(isset($_POST["userType"]))
	{
		$_SESSION['userType'] = $_POST["userType"];
	}

	else
	{
		echo "Not logged in!";
		echo '<br><br>';
		echo '<a href ="loginPage.php">Go Log In</a>';
		
		die();
	}
?>
<html>
<body>

<?php

if(isset($_POST["complex_select_menu"]) && isset($_POST["movie_select_menu"]) )
{
	$complex = $_POST["complex_select_menu"];
	$movie = $_POST["movie_select_menu"];
	echo "<br>complex set: $complex";
	echo "<br>movie set: $movie<br>";
	echo $_SESSION['test'];
}

else
{
	echo "<br>Got here illegally!";
}









?>
