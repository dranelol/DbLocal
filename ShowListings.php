<?php

// Author: Matt Wallace
// Last Edited: 04/28/2015
// I promise this is my code.
// Description:
// Shows all movie listings according to what was selected in MovieListings page


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
	
	if($daysPlus != "All")
	{
		$dayFormatted = explode("-", $daysPlus);
		$dayFormatted = date("m/d/Y", mktime(0,0,0, $dayFormatted[1], $dayFormatted[2], $dayFormatted[0]));
		
		echo "<br>Day selected: $dayFormatted";
	}
	
	else
	{
		echo "<br>Day selected: $daysPlus";
	}
	
	echo "<br>Complex selected: $complex";
	echo "<br>Movie selected: $movie";
	
	if($complex == "all")
	{
		echo "<br><br>";
		$listingsQueryBase = "select S.ID, C.Name, M.Title, M.Rating, S.ShowDate, S.ShowTime, C.Address, S.SeatsAvailable
										from MovieShowing S, Cinema C, Movie M 
										where C.ID = S.CinemaID
										and S.MovieId = M.ID";
		// without an addition, this will work for all cinemas, all movies, all days
		$listingsQuery = $listingsQueryBase;
		
		// if we selected a specific day
		if($daysPlus != "All")
		{
			$listingsQuery = $listingsQuery .
				" and S.ShowDate = '{$dayToCheck}'";
		}
		
		// if we selected a specific movie
		if($movie != "all")
		{
			$listingsQuery = $listingsQuery .
				" and M.Title = '{$movie}'";
		}
		 
		$sublistingsQueryBase = "$listingsQuery";
		
		$listingsQuery = $listingsQuery . " order by C.Name, M.Title, S.ShowDate, S.ShowTime";
			
		//echo "<br><br> $listingsQuery";
			
		$listingsResult = mysql_query($listingsQuery);// or die(mysql_error());
		
		$cinemasQuery = "select * from Cinema";
		$cinemaResult = mysql_query($cinemasQuery) or die(mysql_error());
		
		
		
		if($listingsResult)
		{
			if(mysql_num_rows($listingsResult))
			{
				while($cinemaRow = mysql_fetch_array($cinemaResult))
				{
					$cinemaName = $cinemaRow['Name'];
					$cinemaAddress = $cinemaRow['Address'];
					$cinemaID = $cinemaRow['ID'];
					
					
					
					echo "<h2>$cinemaName</h2>";
					echo "<h3>$cinemaAddress</h3>";
					
					// check to see if this cinema has any listings
					// if it does, show its listings, if not, say no listings for this cinema
					
					$checkListingsQuery = "select * from MovieShowing M where M.CinemaID = '$cinemaID'";
					$checkListingsResult = mysql_query($checkListingsQuery) or die(mysql_error());
					
					if(mysql_num_rows($checkListingsResult) > 0)
					{
						echo "<table border = \"100\" cellpadding = \"10\">";
						echo "<tr> 
								  <th>Cinema Name</th>
								  <th>Movie Name</th>  
								  <th>Rating</th>  
								  <th>Show Date</th>
								  <th>Show Time</th>
								  <th>Seats Available</th>
								  </tr>";
								  
						
						
						$sublistingsQuery = $sublistingsQueryBase . " and C.ID = '{$cinemaID}'" . " order by M.Title, S.ShowDate, S.ShowTime";
						
						$sublistingsResult = mysql_query($sublistingsQuery) or die (mysql_error());
						
						while($row = mysql_fetch_array($sublistingsResult))
						{
							echo "<tr>
									  <td>" . $row['Name']. "</td>
									  <td>" . $row['Title']. "</td>
									  <td>" . $row['Rating']. "</td>
									  <td>" . $row['ShowDate']. "</td>
									  <td>" . $row['ShowTime']. "</td>
									  <td>" . $row['SeatsAvailable'] . "</td>";
							if($row['SeatsAvailable'] == '0')
							{
								echo "<td><input type='submit' value='No seats' disabled></td>";
							}
							
							else
							{
								echo "<td>
										  <form action = 'Reservations.php' method = 'post'>
										  <input type = 'hidden' name = 'ShowingID' value ='" . $row['ID'] . "'>
										  <input type='submit' value='Reserve Seats'>
										  </form>
										  </td>";
							}
							
							echo "</tr>";
						}
						
						echo "</table>";
					}
					
					else
					{
						echo "No listings for this cinema. <br>";
					}
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
		echo "<br><br>";
		$listingsQueryBase = "select S.ID, C.Name, M.Title, M.Rating, S.ShowDate, S.ShowTime, C.Address, S.SeatsAvailable
										from MovieShowing S, Cinema C, Movie M 
										where C.ID = S.CinemaID
										and S.MovieId = M.ID";
		// without an addition, this will work for all cinemas, all movies, all days
		$listingsQuery = $listingsQueryBase;
		
		// if we selected a specific day
		if($daysPlus != "All")
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
				echo "<table border = \"100\" cellpadding = \"10\">";
				echo "<tr> 
						  <th>Cinema Name</th>
						  <th>Movie Name</th> 
						  <th>Rating</th> 
						  <th>Show Date</th>
						  <th>Show Time</th>
						  <th>Seats Available</th>
						  </tr>";
						  
				while($row = mysql_fetch_array($listingsResult))
				{
					echo "<tr>
							  <td>" . $row['Name']. "</td>
							  <td>" . $row['Title']. "</td>
							  <td>" . $row['Rating']. "</td>
							  <td>" . $row['ShowDate']. "</td>
							  <td>" . $row['ShowTime']. "</td>
							  <td>" . $row['SeatsAvailable'] . "</td>";
							  
					if($row['SeatsAvailable'] == '0')
					{
						echo "<td><input type='submit' value='No seats' disabled></td>";
					}
					
					else
					{
						echo "<td>
								  <form action = 'Reservations.php' method = 'post'>
								  <input type = 'hidden' name = 'ShowingID' value ='" . $row['ID'] . "'>
								  <input type='submit' value='Reserve Seats'>
								  </form>
								  </td>";
					}
					
					echo "</tr>";
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
	}
	
	
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
}

else
{
	echo '<br>Got here illegally!';
	echo "<br>";
	echo "<form action ='index.php'>";
	echo "<input type ='submit' value = 'Go back to index' >";  
	echo "</form>";
}

?>

</body>
</html>
