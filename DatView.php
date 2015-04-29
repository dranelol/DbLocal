<!--
Name: Matthew Williamson
CLID: MCW4553
Date: 4/29/2015
CoA: I certify this is entirely my work
-->

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
        <title> datview </title>
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


<h1> what did you see...<hr></h1>


<body>

<?php 

	$sessionUser = $_SESSION['userType'];
    $date = $_SESSION["today"];
    $time = date('Y-m-d');
	 
    echo "Logged in as: <b> $sessionUser </b><br>";	
    echo "Member ID: <b>";
    if($_SESSION['memberID'] == NULL) 
        echo("NULL");
    else
        echo($_SESSION['memberID']);
    
    echo"</b> <br>";
    
    echo "Today's date: <b>$date</b> <br>";
    echo "<hr>";
    
   
?> 

<?php  
    //is the memberSelection variable set from where this page is loaded from?

    if (isset ($_POST['MemberSelection']))
    {
        $memberSelection = $_POST['MemberSelection'];
        $accountSelection = $_POST['AccountSelection'];
        
        echo("<h1>Viewing Account #$accountSelection</h1><hr>");
        //print the memberSelection to see what we got
       
        
        if($memberSelection == 'All')//view selection for whole account
        {
            
            $seentItQuery = 
                "select 
                    B.Name as User, C.Name, S.MovieID, M.Title, S.ShowTime 
                    from 
                        Member B, Movie M, Cinema C, Reservation R, MovieShowing S 
                    where
                        C.ID = S.CinemaID 
                        and R.MovieShowingID = S.ID 
                        and S.MovieID = M.ID 
                        and R.MemberID = B.ID 
                        and R.MembershipID = '$accountSelection'
                        order by M.Title, B.Name";
                        
            
        }        
        else //it's a specific user
        {
            
            $seentItQuery = "select B.Name as User, C.Name, S.MovieID, M.Title, S.ShowTime 
            from Member B, Movie M, Cinema C, Reservation R, MovieShowing S
            where   C.ID = S.CinemaID 
                and R.MovieShowingID = S.ID 
                and S.MovieID = M.ID 
                and R.MemberID = B.ID 
                and R.MembershipID = '$accountSelection'
                and B.Name = '$memberSelection'"; 
        } 
        
        $seentItResult = mysql_query($seentItQuery) or die(mysql_error());
        if(mysql_num_rows($seentItResult))
        {
            echo "<table border = \"1\" cellpadding = \"10\">";
            echo "<caption align = 'left'> Displaying Information for: <b>$memberSelection</b> </caption>";
                echo "<tr> 
                          <th>Member</th> 
                          <th>Cinema</th> 
                          <th>Movie</th> 
                          <th>Time</th>
                      </tr>";
            
            while($row = mysql_fetch_array($seentItResult))
            {                
                echo "<tr>
                          <td>" . $row['User'].     "</td>
                          <td>" . $row['Name'].     "</td>
                          <td>" . $row['Title'].    "</td>
                          <td>" . $row['ShowTime']. "</td>
                      </tr>";
            } 
            
            echo "</table>";
            echo"<br>";
        }
        else
        {
            if($memberSelection != "All")            
                echo("<h1>No viewing history available for $memberSelection</h1>");
            else
                echo("<h1>No viewing history available for Account #$accountSelection</h1>");
        }
        
    }
    else
    {
        echo " something bad happened... the memberSelection variable was not set.... you should not be here";    
    }
 

?>



 <form action = 'ViewingHistory.php'>
        <input type ='submit' value = 'Go back to Viewing History Selection' align = 'left' >
    </form> 
 

</body>
</html>
 