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
    echo "Member ID: <b> {$_SESSION['memberID']} </b> <br>";
    echo "Today's date: <b>$date</b> <br>";
    echo "<hr>";
    
   
?> 

<?php  
    //is the viewSelection variable set from where this page is loaded from?
    if($_SESSION['memberID'] == "member")
    {
        if (isset ($_POST['viewSelection']))
        {
            $viewSelection = $_POST['viewSelection'];
            //print the viewSelection to see what we got
           
            
            if($viewSelection == 'Account')//view selection for whole account
            {
                $seentItQuery = "select B.Name as User, C.Name, S.MovieID, M.Title, S.ShowTime 
                from Member B, Movie M, Cinema C, Reservation R, MovieShowing S
                where   C.ID = S.CinemaID 
                    and R.MovieShowingID = S.ID 
                    and S.MovieID = M.ID 
                    and R.MemberID = B.ID 
                    and R.MembershipID = '{$_SESSION['memberID']}'";   
            }                
            else //it's a specific user
            {
                $seentItQuery = "select B.Name as User, C.Name, S.MovieID, M.Title, S.ShowTime 
                from Member B, Movie M, Cinema C, Reservation R, MovieShowing S
                where   C.ID = S.CinemaID 
                    and R.MovieShowingID = S.ID 
                    and S.MovieID = M.ID 
                    and R.MemberID = B.ID 
                    and R.MembershipID = '{$_SESSION['memberID']}'
                    and B.Name = '$viewSelection'"; 
            } 
            
            $seentItResult = mysql_query($seentItQuery) or die(mysql_error());
            
            echo "<table border = \"1\" cellpadding = \"10\" align = \"left\">";
            echo "<caption> Displaying Information for: <b>$viewSelection</b> </caption>";
                echo "<tr> 
                          <th>Member</th> 
                          <th>Cinema</th> 
                          <th>Movie</th> 
                          <th>Time</th>
                      </tr>";
                   
                while($row = mysql_fetch_array($seentItResult)){                
                    echo "<tr>
                              <td>" . $row['User'].     "</td>
                              <td>" . $row['Name'].     "</td>
                              <td>" . $row['Title'].    "</td>
                              <td>" . $row['ShowTime']. "</td>
                          </tr>";
                } 
             echo "</table>";
            } 
        
        else
        {
            echo " something bad happened... the viewSelection variable was not set.... you should not be here";    
        }
    }
    else
    {
        echo "why are you here?... not a member that's why";
    }
?>




 <form action = 'ViewingHistory.php'>
        <input type ='submit' value = 'Go back to Viewing History' >
    </form> 
 

</body>
</html>
 