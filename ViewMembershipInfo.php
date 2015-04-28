<?php

	include "login.php";

	if(isset($_SESSION["userType"]) == false)
	{	
		echo "Not logged in!";
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	
	
?>
<html>
<head>
<title> 
View Membership Information
</title>
</head>

<h3>
View Membership Information
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes

	
	if($sessionUser != "member")
	{
		echo 'Not logged in as a member!';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	

	echo "Logged in as: $sessionUser"; 
	if($sessionUser == "member")
	{
		echo "<br>Membership ID: " . $_SESSION['memberID'] . "<br>";
	}
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 

<br>
<br>

<?php 

	// CODE STARTS HERE
	$membershipID = $_SESSION['memberID'];
	$membershipQuery = "select M.StartDate, M.EndDate from Membership M where M.AcctNum = '$membershipID'";
	$membershipResult = mysql_query($membershipQuery) or die (mysql_error());
	
	$startDate = '';
	$startDateFormatted = '';
	$endDate = '';
	$endDateFormatted = '';
	
	if($row = mysql_fetch_array($membershipResult))
	{
		$startDate = $row['StartDate'];
		$startDateFormatted = explode("-", $startDate );
		$startDateFormatted = date("m/d/Y", mktime(0,0,0, $startDateFormatted[1], $startDateFormatted[2], $startDateFormatted[0]));
		
		$endDate = $row['EndDate'];
		$endDateFormatted = explode("-", $endDate );
		$endDateFormatted = date("m/d/Y", mktime(0,0,0, $endDateFormatted[1], $endDateFormatted[2], $endDateFormatted[0]));
		
	}
	
	echo "Start date for your membership: " . $startDateFormatted . "<br>";
	echo "End date for your membership: " . $endDateFormatted . "<br>";
	
	$membersQuery = "select * from Member M where M.MemberAcctNum = '$membershipID' order by M.MemberAcctOrder";
	$membersResult = mysql_query($membersQuery) or die(mysql_error());
	
	echo "Members in membership: <br>";
	
	echo "<table border = \'1\' cellpadding = \'10\'>";
	echo "<tr> 
			  <th>Name</th> 
			  <th>Address </th> 
			  <th>Email</th>
			  <th>Phone Number</th>
			  <th>Age</th
			  </tr>";
			
	while($row = mysql_fetch_array($membersResult))
	{
		$name = '';
		if($row['MemberAcctOrder'] == '1')
		{
			$name = $row['Name'] . '*';
		}
		else
		{
			$name = $row['Name'] ;
		}
		
		echo "<tr>
						  <td>" . $name . "</td> 
						  <td>" . $row['Address'] . "</td>
						  <td>" . $row['Email'] . "</td>
						  <td>" . $row['PhoneNumber'] . "</td>
						  <td>" . $row['Age'] . "</td>
			   </tr>";
	}
					  
	echo "</table>";
	echo "* denotes primary member for membership account";
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>

</body>
</html>