<?php
// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Login page for employees


include "login.php";
?>

<html>
<head>
<title> 
Employee Login
</title>
</head>

<h3>Employee Login</h3>
<body>

<br>
<br>

<?php 

	if(isset($_POST['employee']))
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
