<?php
include "login.php";
?>

<html>
<head>
<title> 
Admin Login
</title>
</head>

<h3>Admin Login</h3>
<body>

<br>
<br>

<?php 

	if(isset($_POST['admin']))
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