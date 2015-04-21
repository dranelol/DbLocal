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
Schedule Movie Showing
</title>
</head>

<h3>
Schedule Movie Showing
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	if($sessionUser != 'employee' && $sessionUser != "admin")
	{
		echo 'You do not have permission to access this page.';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	

	echo "Logged in as: $sessionUser"; 
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	echo "<br>";


	// Cinema Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Complex ";
	echo "<select name='complex_select_menu'>";
	$complexQuery = "select ID, Name from Cinema";
	$complexResult = mysql_query($complexQuery) or die(mysql_error());
	
	while($row = mysql_fetch_array($complexResult))
	{
			$cinemaID = $row['ID'];
			$cinemaName = $row['Name'];
			
			echo "<option value='$cinemaID'>$cinemaName</option>";
	}
	
	echo "</select>";
	echo "<br>";
	
	
	// Movie Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Movie ";
	echo "<select name='movie_select_menu'>";
	$movieQuery = "select distinct ID, Title from Movie";
	$movieResult = mysql_query($movieQuery) or die(mysql_error());
	
	while($row = mysql_fetch_array($movieResult))
	{
			$movieID = $row['ID'];
			$movieName = $row['Title'];
			
			echo "<option value='$movieID'>$movieName</option>";
	}
	
	echo "</select>";
	echo "<br>";
	
	
	// Theater Selection Menu
	// ---------------------------------------------------------------------
	echo "<br>";
	echo "Theater Number: <input type='text' name='theaterNumber'>";
	echo "<br>";
	
?> 


<br>
Date
<select name="date_select_menu">
	<option value="today">Today</option>
	<option value="today+1">01/02/2015</option>
	<option value="today+2">01/03/2015</option>
	<option value="today+3">01/04/2015</option>
	<option value="today+4">01/05/2015</option>
	<option value="today+5">01/06/2015</option>
	<option value="today+6">01/07/2015</option>
</select>
<br>
<br>

Time
<select name="time_select_menu">
	<option value="00:00">12:00</option>
	<option value="00:30">12:30</option>	
	
	<option value="01:00">01:00</option>
	<option value="01:30">01:30</option>
	
	<option value="02:00">02:00</option>
	<option value="02:30">02:30</option>	
	
	<option value="03:00">03:00</option>
	<option value="03:30">03:30</option>	
	
	<option value="04:00">04:00</option>
	<option value="04:30">04:30</option>	
	
	<option value="05:00">05:00</option>
	<option value="05:30">05:30</option>	
	
	<option value="06:00">06:00</option>
	<option value="06:30">06:30</option>	
	
	<option value="07:00">07:00</option>
	<option value="07:30">07:30</option>	
	
	<option value="08:00">08:00</option>
	<option value="08:30">08:30</option>	
	
	<option value="09:00">09:00</option>
	<option value="09:30">09:30</option>	
	
	<option value="10:00">10:00</option>
	<option value="10:30">10:30</option>	
	
	<option value="11:00">11:00</option>
	<option value="11:30">11:30</option>
</select>
<select name="ampm_select_menu">
	<option value="am">AM</option>
	<option value="pm">PM</option>
</select>
<br>
<br>

<button type="button">Submit</button>

</form>
</body>
</html>
