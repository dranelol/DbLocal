<?php
	include "login.php";
	
	if(isset($_POST["userType"]))
	{
		$_SESSION['userType'] = $_POST["userType"];
	}

	else
	{
		echo "Not logged in!";
		echo '<br><br>';
		echo '<a href ="loginPage.php">Go Log In</a>';
		
		die();
	}
	
?>

<html>
<head>
<title> 
Index for Janksby Database
</title>
</head>
<h3>Index</h3>
<br>
<body>

<br>
<?php 

	$sessionUser = $_SESSION['userType'];

	echo "Logged in as: $sessionUser"; 
	
?> 
<br>
<a href ="MovieListings.php">Movie Listings</a>

<br>

</body>
</html>



