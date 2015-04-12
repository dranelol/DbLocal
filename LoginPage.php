<?php
include "login.php";
?>

<html>
<head>
<title> 
Login Page
</title>
</head>

<h3>Login</h3>

<body>


<br>
Don't lie pls!
<form action = "index.php" method = "post">

<select name="userType">
	<option value="user">User</option>
	<option value="admin">Admin</option>
</select>
<br><br>
<input type = "submit" value = "Log In">
</form>
<br>

</body>
</html>