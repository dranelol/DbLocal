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
		<title> Movie Viewing History</title>
		<style>
			hr { 
				display: block;
				margin-top: 0.5em;
				margin-bottom: 0.5em;
				margin-left: auto;
				margin-right: auto;
				border-style: inset;
				border-width: 1px;
			} 
		</style>
	</head> 
	
<h3>Movie Viewing History</h3><hr> 

<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	$date = $_SESSION["today"];
	$time = date('Y-m-d');	   
	$currentMember = $_SESSION['memberID'];
	
	echo "Logged in as: <b> $sessionUser </b><br>";	
	echo "Member ID: <b>";
	if($currentMember == NULL) 
		echo("NULL");
	else
		echo($currentMember);
	
	echo"</b> <br>";
	
	echo "Today's date: <b>$date</b> <br>";
	echo "<hr>";
	
?> 

<!--
|Movie viewing history|
	-For either a selected individual or a selected account, show a list of the movies they have seen. 
	-If the listing is for an account, list the movies seen by each member associated with the account.
	-The account history will be in alphabetical order by movie title within member (in alphabetical order).
-->
<form action = 'ViewingHistory.php' method = 'post'>
	<?php  
        
        //this is what gets posted to the next page from the action
        echo "Select Account";
        echo "<br>";
        echo "<select name = 'AccountSelection'>";
        //echo "<option selected='true' disabled='true' > Choose an Account...</option>";
        $AccountQuery = "select distinct AcctNum from Membership";
        $AccountResult = mysql_query($AccountQuery) or die(mysql_error());
        
        while($row = mysql_fetch_array($AccountResult))
        {	
            $accountID = $row['AcctNum'];
            echo "<option value = '$accountID' align = center> $accountID";
            echo "</option>";
            
             
        }	 
        
        echo"</select>";
        echo "<input type='submit' value='Submit' name = 'SubmitAccount'>";

        
    ?>
<br>
<br>
</form>

<form action = 'DatView.php' method = 'post'>
<?php

    if(isset($_POST['SubmitAccount']))
    {   
        if(isset($_POST['AccountSelection']))
        { 
            $acc = $_POST['AccountSelection'];

            echo "<h1>Select a Member from Account $acc</h1>"; 
            echo"<select name = 'MemberSelection'>";
            
            echo "<option selected='true'> All </option>";
            $memberQuery = "SELECT * FROM Member where MemberAcctNum = $acc";		  
            $memberResult = mysql_query($memberQuery) or die(mysql_error());	       
        
            while($row = mysql_fetch_array($memberResult))
            {
                $memberID = $row['Name'];
                echo "<option value = '$memberID' > $memberID </option>";
            }

            echo"</select>";
            echo"<input type = 'hidden' value = '$acc' name = 'AccountSelection'>";
            echo"<input type = 'submit' value = 'Submit'><br> <br>";
            
        }
        else
        {
            echo("No account selected please select an account...");
        
        }
    }
    
?>
</form>

<!--		
<form action = 'ViewingHistory.php'>

	<?php		
    /*
    if(isset($_POST['SubmitAccount']))
    {
        echo"<input type = 'submit' value = 'Cancel' name = 'Cancel'> <br> <br>";
    }
    */
 	?>	

</form>
-->
<form action = 'index.php'>
	<?php		 
		echo"<input type ='submit' value = 'Go back to index' >";	 
	?>		  
</form> 
</body>
</html>


















