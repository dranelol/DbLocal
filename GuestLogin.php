<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Login page for guests.


include "login.php";
?>

<html>
<head>
<title> 
Guest Login
</title>
</head>

<h3>Guest Login</h3>
<body>

<br>
<br>

<?php 

	if(isset($_POST['guest']))
	{
		header('location:index.php');

	}
	
	else
	{
		echo '<br>Got here illegally!';
		echo "<br>";
		echo "<form action ='index.php'>";
		echo "<input type ='submit' value = 'Go back to index' >";  
		echo "</form>";   
	}
?>

</body>
</html>
