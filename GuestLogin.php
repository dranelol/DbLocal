<?php
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
		echo '<br><a href ="LoginPage.php">Go to Login Page</a>';
	}
?>

</body>
</html>
