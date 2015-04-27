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
Show Listings
</title>
</head>

<h3>Show Movie Listings</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];

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

if(isset($_POST["complex_select_menu"]) 
	&& isset($_POST["movie_select_menu"])
    && isset($_POST["day_select_menu"]))
{
	$complex = $_POST["complex_select_menu"];
	
	//echo $_POST['allDays'];
	$movie = $_POST["movie_select_menu"];
	$daysPlus = $_POST["day_select_menu"];
	
	$dayToCheck = $daysPlus;
	
	if($daysPlus != "all")
	{
		$dayFormatted = explode("-", $daysPlus);
		$dayFormatted = date("m/d/Y", mktime(0,0,0, $dayFormatted[1], $dayFormatted[2], $dayFormatted[0]));
		echo "<br>day selected: $dayFormatted";
	}
	
	else
	{
		echo "<br>day selected: $daysPlus";
	}
	
	echo "<br>complex selected: $complex";
	echo "<br>movie selected: $movie";
	
	echo "<br><br>";
	$listingsQueryBase = "select S.ID, C.Name, M.Title, S.ShowDate, S.ShowTime
									from MovieShowing S, Cinema C, Movie M 
									where C.ID = S.CinemaID
									and S.MovieId = M.ID";
	// without an addition, this will work for all cinemas, all movies, all days
	$listingsQuery = $listingsQueryBase;
	
	// if we selected a specific day
	if($daysPlus != "all")
	{
		$listingsQuery = $listingsQuery .
			" and S.ShowDate = '{$dayToCheck}'";
	}
	
	// if we selected a specific complex
	if($complex != "all")
	{
		$listingsQuery = $listingsQuery .
			" and C.Name = '{$complex}'";
	}
	
	// if we selected a specific movie
	if($movie != "all")
	{
		$listingsQuery = $listingsQuery .
			" and M.Title = '{$movie}'";
	}
	 
	$listingsQuery = $listingsQuery . " order by C.name, M.Title, S.ShowDate, S.ShowTime";
		
		
	//echo "<br><br> $listingsQuery";
		
	$listingsResult = mysql_query($listingsQuery);// or die(mysql_error());
	
	if($listingsResult)
	{
		if(mysql_num_rows($listingsResult))
		{
			echo "<table border = \"1\" cellpadding = \"10\">";
			echo "<tr> 
					  <th>Cinema Name</th> 
					  <th>Movie Name</th> 
					  <th>Show Date</th>
					  <th>Show Time</th
					  </tr>";
					  
			while($row = mysql_fetch_array($listingsResult))
			{
				echo "<tr>
						  <td>" . $row['Name']. "</td>
						  <td>" . $row['Title']. "</td>
						  <td>" . $row['ShowDate']. "</td>
						  <td>" . $row['ShowTime']. "</td>
						  <td>
						  <form action = 'Reservations.php' method = 'post'>
						  <input type = 'hidden' name = 'ShowingID' value ='" . $row['ID'] . "'>
						  <input type='submit' value='Reserve Seats'>
						  </form>
						  </td>
						  </tr>";
			}
			
			echo "</table>";
		}
		
		else
		{
			echo "<br>No listings for that selection!";
		}
		
	}
	
	else
	{
		echo "<br>Null result!";
	}
	
	
	
	
	echo '<br><a href ="index.php">Go to Index</a>';
}

else
{
	echo '<br>Got here illegally!';
	echo '<br><a href ="index.php">Go to Index</a>';
}

?>

</body>
</html>
