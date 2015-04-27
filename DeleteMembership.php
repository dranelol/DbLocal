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
Delete a Membership
</title>
</head>

<h3>
Delete a Membership
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	
	if($sessionUser != "admin")
	{
		echo 'You do not have permission to view this page.';
		echo '<br><br>';
		echo '<a href ="LoginPage.php">Go Log In</a>';
		
		die();
	}
	
	echo "Logged in as: $sessionUser"; 
	
	$date = $_SESSION["today"];
	echo "<br>";
	echo "Today's date: $date";
	
?> 

<br>
<br>

<?php

	if(isset($_POST['membershipToDelete']))
	{
		$acctNum = $_POST['membershipToDelete'];
		
		$deleteMembershipQuery = "delete from Membership where AcctNum=$acctNum";

	
		if(mysql_query($deleteMembershipQuery) or die(mysql_error()))
		{
			echo "Membership $acctNum has been successfully removed.<br>";
		}
				
		else
		{
			echo "<br>Could not delete membership.";
			echo '<br><a href ="DeleteMembership.php">Go Back</a>';			
		}	
	}
		
	else	
	{
		$membershipQueryResult = mysql_query("select AcctNum from Membership order by AcctNum;") or die(mysql_error());	

		if(mysql_num_rows($membershipQueryResult))
		{
			echo "<form action='DeleteMembership.php' method='post'>";
			echo "Delete Membership: ";
			echo "<select name='membershipToDelete'>";
			
			while($membershipRow = mysql_fetch_array($membershipQueryResult))
			{
					$acctNum = $membershipRow['AcctNum'];
					
					echo "<option value='$acctNum'>$acctNum</option>";
			}
			
			echo "</select>";
			echo "<br><br>";
			echo "<input type='submit' value='Delete Membership'>";
			echo "</form>";
		}
		
		else
		{
			echo "No existing memberships.<br>";
		}
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>

</body>
</html>