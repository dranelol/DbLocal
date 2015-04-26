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


<h3> what did you see...<hr></h3>


<body>

<?php 

	$sessionUser = $_SESSION['userType'];
    $date = $_SESSION["today"];
    $time = date('Y-m-d');
	
    
    echo "Logged in as: <b> $sessionUser </b><br>";	
    echo "Member ID: <b> {$_SESSION['memberID']} </b> <br>";
    echo "Today's date: <b>$date</b><br>";
    echo "<hr>";
    
    echo"<form action = 'ViewingHistory.php'>
            <input type ='submit' value = 'Get back hooker' >
            </form>";
?> 

<?php
        $seentItQuery = "select C.Name, M.Title, S.ShowTime 
        from Movie M, Cinema C, Reservation R, MovieShowing S 
        where C.ID = S.CinemaID and R.MovieShowingID = S.ID and S.MovieID = M.ID and R.MembershipID = '{$_SESSION['memberID']}'";
        $seentItResult = mysql_query($seentItQuery) or die(mysql_error());

        if($seentItResult){	
            if(mysql_num_rows($seentItResult)){		
                echo "<table border = \"1\" cellpadding = \"10\" align = \"left\">";
                    echo "<tr> 
                              <th>Name</th> 
                              <th>Title</th> 
                              <th>ShowTime</th>
                          </tr>";
                      //MemberID | MembershipID | MovieShowingID | SeatRow | SeatColumn
                    while($row = mysql_fetch_array($seentItResult)){                
                        echo "<tr>
                                  <td>" . $row['Name'].     "</td>
                                  <td>" . $row['Title'].    "</td>
                                  <td>" . $row['ShowTime']. "</td>
                              </tr>";
                    } 
                 echo "</table>";
            }  
        }
        else{    
            echo "you suck...";    
        }    
    ?>

</body>
</html>
 