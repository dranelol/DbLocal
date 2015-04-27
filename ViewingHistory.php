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
    
    echo "Logged in as: <b> $sessionUser </b><br>";	
    echo "Member ID: <b> {$_SESSION['memberID']} </b> <br>";
    echo "Today's date: <b>$date</b><br>";    
    echo "<hr>"; 
    
?> 

<!--
|Movie viewing history|
    -For either a selected individual or a selected account, show a list of the movies they have seen. 
    -If the listing is for an account, list the movies seen by each member associated with the account.
    -The account history will be in alphabetical order by movie title within member (in alphabetical order).
-->

<form action = 'DatView.php' method = 'post'>
    <?php  
    if($_SESSION['userType'] == "guest"){    
        echo("lol ur a guest... Guess do not have viewing history?");
    }
    else if($_SESSION['userType'] == "employee"){
        echo("lol ur an employee.. Employees dont have viewing history?");
    }
    else
    {
        //$memberQuery = "SELECT * FROM Member where MemberAcctNum = '{$_SESSION['memberID']}'";
        //$memberResult = mysql_query($memberQuery) or die(mysql_error());
        
        //select C.Name 
        //from Cinema C, Reservation R, MovieShowing S 
        //where C.ID = S.CinemaID and R.MovieShowingID = S.ID and R.ID = $thisReservationID 
        //<select name="movie_select_menu">
        //<option value="all">all</option>
        //
        echo"<select name = 'viewSelection'>";
        echo"<option value = 'Account'> Account </option>";
        
        while($row = mysql_fetch_array($memberResult)){    
            echo "<option value = '{$row['Name']}' >{$row['Name']}</option>";
        } 
        
        echo"</select>";
       
        echo"<input type = 'submit' name = 'Submit Form'> <br> <br>  ";
    }
    ?>
        
    
</form>
 
<form action = 'index.php'>
    <?php        
        echo"<input type ='submit' value = 'Go back to index' >";    
    ?>        
</form> 
</body>
</html>


















