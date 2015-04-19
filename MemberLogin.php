<?php
include "login.php";
?>

<html>
<head>
<title> 
Member Login
</title>
</head>

<h3>Member Login</h3>
<body>

<br>
<br>

<form action = "index.php" method = "post">

<?php 

	if(isset($_POST['member']))
	{
		$userType = $_POST['member'];
		
		if($userType = 'member')
		{
			echo "Select your member ID<br>";
			
			echo "<select name='memberID'>";
			
			$membersQuery = "select ID from Member";
			
			$membersResult = mysql_query($membersQuery) or die(mysql_error());
			
			while($row = mysql_fetch_array($membersResult))
			{
				$memberID = $row['ID'];
				
				echo "<option value='$memberID'>$memberID</option>";
			}
			
			
			
					  //<option value="member">Member</option>
			echo "</select>";
			echo "<br>";
			echo "<input type ='hidden' value = 'member' name ='userType'>";
			echo "<input type='submit' value='Login'></form>";

			
			echo "<br>";
			
		}
	}
	
	else
{
	echo '<br>Got here illegally!';
	echo '<br><a href ="LoginPage.php">Go to Login Page</a>';
}
?>

</form>

</body>
</html>