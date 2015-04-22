<?php
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
		echo '<br><a href ="LoginPage.php">Go to Login Page</a>';
	}
?>

</body>
</html>
