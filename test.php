<?php
include "login.php";
?>
<html>
<head>
<title> 
Test
</title>
</head>

<h3>Test</h3>
<br>
<body>

<?php

	$query1 = "select extract(day from ShowDate) as Day from MovieShowing where ID=1"; 
	$result1 = mysql_query($query1) or die(mysql_error());
	while($row1 = mysql_fetch_array($result1))
	{
		echo "<br><br>{$row1['Day']}";
	}

	$query1 = "select extract(month from ShowDate) as Month from MovieShowing where ID=1"; 
	$result1 = mysql_query($query1) or die(mysql_error());
	while($row1 = mysql_fetch_array($result1))
	{
		echo "<br><br>{$row1['Month']}";
	}

	$query1 = "select extract(year from ShowDate) as Year from MovieShowing where ID=1"; 
	$result1 = mysql_query($query1) or die(mysql_error());
	while($row1 = mysql_fetch_array($result1))
	{
		echo "<br><br>{$row1['Year']}";
	}


?>


</body>
</html>
