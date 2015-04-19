<?php
	include "login.php";
	
	$_SESSION["userType"] = null;
	$_SESSION["today"] = null;
	
	echo "Cleared session variables!";
?>