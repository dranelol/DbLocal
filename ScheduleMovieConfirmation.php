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
Schedule Movie Showing
</title>
</head>

<h3>
Schedule Movie Showing
</h3>
<body>

<?php 

	$sessionUser = $_SESSION['userType'];
	
	// restrict access only to certain userTypes
	if($sessionUser != 'employee' && $sessionUser != "admin")
	{
		echo 'You do not have permission to access this page.';
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
	echo "<br>";
	
?> 
<br>
<br>

<?php 
	if(isset($_POST['complex_select_menu']) && isset($_POST['movie_select_menu']) && isset($_POST['theaterNumber']) && isset($_POST['date_select_menu']) && isset($_POST['time_select_menu']))
	{
		$cinemaID = $_POST['complex_select_menu'];
		$movieID = $_POST['movie_select_menu'];
		$theaterNumber = $_POST['theaterNumber'];
		$date = $_POST['date_select_menu'];
		$time = $_POST['time_select_menu'];
				
		$theaterQueryResult = mysql_query("select * from Theater where TheaterNumber=$theaterNumber and CinemaID=$cinemaID;") or die(mysql_error());
		
		if ($trow = mysql_fetch_array($theaterQueryResult))
		{
			$theaterID = $trow['ID'];	
			$movieShowingQueryResult = mysql_query("select * from MovieShowing where CinemaID=$cinemaID and TheaterID=$theaterID and ShowDate='$date' and ShowTime='$time';") or die(mysql_error());
		
			$cinemaName = mysql_fetch_array(mysql_query("select Name from Cinema where ID=$cinemaID"))['Name'];
			$movieName = mysql_fetch_array(mysql_query("select Title from Movie where ID=$movieID"))['Title'];
		
			if ($msrow = mysql_fetch_array($movieShowingQueryResult))
			{
				echo "<br>A show has already been scheduled at $time, $date in theater $theaterNumber, $cinemaName.<br>";
				echo "<a href ='ScheduleMovie.php'>Go back to Schedule Movie Showings page</a>";
			}
			
			else
			{
				$insertMovieShowing = "insert into 
													MovieShowing (CinemaID, TheaterID, MovieID, ShowDate, ShowTime)
													values ($cinemaID, $theaterID, $movieID, '$date', '$time')"; 
													
				mysql_query($insertMovieShowing) or die(mysql_error());
				
				echo "<br>Show scheduled for $movieName at $time, $date in theater $theaterNumber, $cinemaName.<br>";
				echo "<a href ='index.php'>Go back to index</a>";
			}
		}
		
		else
		{
			echo "<br>Invalid theater number. Theater $theaterNumber does not exist at cinema $cinemaID.<br>";
			echo "<a href ='ScheduleMovie.php'>Go back to Schedule Movie Showings page</a>";
		}

	}
	
	else
	{
		echo '<br>gtfo';
		echo '<br><a href ="ScheduleMovie.php">Go to Schedule Movie Showings page</a>';
	}
?> 
 
</body>
</html>