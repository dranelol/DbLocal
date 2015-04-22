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
<br>
Don't lie pls!

<form action = "index.php" method = "post">
<input type ='hidden' name='userType' value ='guest'>
<input type='submit' value='Guest Login'>
</form>

<form action = "MemberLogin.php" method = "post">
<input type='submit' value='Member Login' name='member'>
</form>


<form action = "index.php" method = "post">
<input type ='hidden' name='userType' value ='admin'>
<input type='submit' value='Admin Login'>
</form>

<form action = "index.php" method = "post">
<input type ='hidden' name='userType' value ='employee'>
<input type='submit' value='Employee Login'>
</form>

<br>

</body>
</html>