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
<body>

<?php 

	$sessionUser = $_SESSION['userType'];

	echo "Logged in as: $sessionUser"; 
	
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
	$movie = $_POST["movie_select_menu"];
	$daysPlus = $_POST["day_select_menu"];
	$dayToCheck = "";
	if($daysPlus != "all")
	{
		$todaysDate = explode("/", $_SESSION["today"]);
		
		$dayToCheck = date("Y-m-d", mktime(0,0,0, $todaysDate[0], $todaysDate[1] + $daysPlus, $todaysDate[2]));
		
		echo "<br>day selected: $dayToCheck";
	}
	
	else
	{
		echo "<br>day selected: $daysPlus";
	}
	
	echo "<br>complex selected: $complex";
	echo "<br>movie selected: $movie";
	
	// NOTE: STOP BEING A SHITLORD AND DYNAMICALLY BUILD THIS QUERY 
	$listingsQueryBase = "select C.Name, M.Title, S.ShowDate, S.ShowTime
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
		
	
	/* EXAMPLES
	
	// all complexes, all days, all movies
	
	select C.Name, M.Title, S.ShowDate, S.ShowTime
		from MovieShowing S, Cinema C, Movie M 
		where C.ID = S.CinemaID
		and S.MovieId = M.ID
	
	// specific complex, all days, all movies
	
	select C.Name, M.Title, S.ShowDate, S.ShowTime
		from MovieShowing S, Cinema C, Movie M 
		where C.ID = S.CinemaID
		and C.Name = '{$complex}'
		and S.MovieId = M.ID
		
		
	// specific complex, specific day, all movies
	
	select C.Name, M.Title, S.ShowDate, S.ShowTime
		from MovieShowing S, Cinema C, Movie M 
		where C.Name = '{$complex}'
		and S.ShowDate = '{$dayToCheck}'
		and C.ID = S.CinemaID
		and S.MovieId = M.ID
	
	
	// specific complex, specific day, specific movie
	
	select C.Name, M.Title, S.ShowDate, S.ShowTime
		from MovieShowing S, Cinema C, Movie M 
		where C.Name = '{$complex}'
		and S.ShowDate = '{$dayToCheck}'
		and M.Name = '{$movie}'
		and C.ID = S.CinemaID
		and S.MovieId = M.ID
	
	*/
		
	//echo "<br><br> $listingsQuery";
		
	$listingsResult = mysql_query($listingsQuery);// or die(mysql_error());
	
	if($listingsResult)
	{
		if(mysql_num_rows($listingsResult))
		{
			echo "<table border = \"1\" cellpadding = \"10\" align = \"center\">";
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
						  </tr>";
			}
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
	
	
	
	
	
}

else
{
	echo '<br>Got here illegally!';
	echo '<br><a href ="index.php">Go to Index</a>';
}









?>
