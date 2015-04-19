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



<form action = "MemberLogin.php" method = "post">
<input type='submit' value='Member Login' name='member'>
</form>


<form action = "AdminLogin.php" method = "post">
<input type='submit' value='Admin Login' name='admin'>
</form>

<form action = "EmployeeLogin.php" method = "post">
<input type='submit' value='Employee Login' name='employee'>
</form>





<br>

</body>
</html>