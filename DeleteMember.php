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
Delete a Member
</title>
</head>

<h3>
Delete a Member
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

	if(isset($_POST['memberToDelete']))
	{
		$memberID = $_POST['memberToDelete'];
		
		$primaryMemberQuery = "select AcctNum from Membership where PrimaryMemberID=$memberID";
		$primaryMemberResult = mysql_query($primaryMemberQuery);
		
		if(mysql_num_rows($primaryMemberResult))
		{			
			if ($membershipRow = mysql_fetch_array($primaryMemberResult))
			{
				$acctNum = $membershipRow['AcctNum'];
				echo "Member $memberID is the primary membership holder. Membership $acctNum has been successfully removed.<br>";
			
				$deleteMembershipQuery = "delete from Membership where AcctNum=$acctNum;";
				if(mysql_query($deleteMembershipQuery) or die(mysql_error()))
				{
					echo "Member ID: $memberID is the primary membership ID. Membership ID: $acctNum has been successfully removed.<br>";
				}
				
				else
				{
					echo "<br>Could not delete member.";
					echo '<br><a href ="DeleteMember.php">Go Back</a>';			
				}
			}
		}
		
		else
		{
			$deleteMemberQuery = "delete from Member where ID=$memberID;";							
			if(mysql_query($deleteMemberQuery) or die(mysql_error()))
			{
				echo "Member successfully deleted!<br>";
			}
			else
			{
				echo "<br>Could not delete member.";
				echo '<br><a href ="DeleteMember.php">Go Back</a>';			
			}
		}
	}
	else	
	{
		$memberQueryResult = mysql_query("select * from Member order by MemberAcctNum;") or die(mysql_error());	

		if(mysql_num_rows($memberQueryResult))
		{
			echo "<form action='DeleteMember.php' method='post'>";
			echo "Delete Member: ";
			echo "<select name='memberToDelete'>";
			
			while($memberRow = mysql_fetch_array($memberQueryResult))
			{
					$memberID = $memberRow['ID'];
					$memberName = $memberRow['Name'];
					$memberAcctNum = $memberRow['MemberAcctNum'];
					
					echo "<option value='$memberID'>($memberAcctNum-$memberID) $memberName</option>";
			}
			
			echo "</select> (AcctNum-MemberID) Name";
			echo "<br><br>";
			echo "<input type='submit' value='Delete Member'>";
			echo "</form>";
		}
		
		else
		{
			echo "No existing members.<br>";
		}
	}
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";   
?>

</body>
</html>