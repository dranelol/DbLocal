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
	
?>

</body>
</html>



</body>
</html>