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
		echo '<br><a href ="LoginPage.php">Go to Login Page</a>';
	}
	
?>


</body>
</html>