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
Reservations for Movie Showing
</title>
</head>

<h3>Reservations for Movie Showing</h3>
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
	
	// BLOW MIND SHIT DONT WORRY IT WORKS
?> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script>
			var hiddenInputClass = 'memberInfoSelect';
			var selectId = 'memberInfo'
			$(document).ready(function(){
				$("#"+selectId).change(function(){
					var v = $(this).val();
					$("."+hiddenInputClass).each(function(){
						$(this).val(v);
					});
				
				});
			});
		</script>
	<?php
	
?> 
<br>
<br>


<?php
	if(isset($_POST['ShowingID']))
	{
		$showingID = $_POST['ShowingID'];
		$memberID = $_SESSION['memberID'];
		
		
		$showingQuery = "select S.ShowDate, S.ShowTime, C.Name, T.TheaterNumber, M.Title
									from MovieShowing S, Movie M, Cinema C, Theater T
									where S.ID = $showingID
									and S.MovieID = M.ID
									and S.CinemaID = C.ID
									and S.TheaterID = T.ID";
		$showingResult = mysql_query($showingQuery) or die(mysql_error());
		if($row = mysql_fetch_array($showingResult))
		{
			$showDate = $row['ShowDate'];
			echo "Reservations for: " . $row['Title'] . " <br>
					  Cinema: " . $row['Name'] . " <br>
					  Show date/time: " . $row['ShowDate'] . " at " . $row['ShowTime'] . " <br>
			
			
					  <body>";
					  
		}
		
		$membersQuery = "select M.ID, M.Name, M.MemberAcctNum, M.MemberAcctOrder from Member M where M.MemberAcctNum = $memberID";
		
		$membersResult = mysql_query($membersQuery) or die(mysql_error());
		
		echo "<br>";
		echo "Select member to reserve seat for";
		echo "<br>";
		echo "<select id='memberInfo'>";
		echo "<option value='none'>Select member</option>";
		
		while($row = mysql_fetch_array($membersResult))
		{
			$memberID = $row['ID'];
			$memberName = $row['Name'];
			$memberAcct = $row['MemberAcctNum'];
			$memberAcctOrder = $row['MemberAcctOrder'];
			echo "<option value='$memberName:$memberID'>$memberName, account $memberAcct:$memberAcctOrder</option>";
		}
		
		echo "</select>";
		echo "<br>";
		
		$seatQuery = "select S.SeatingChart, T.SeatingRows, T.SeatingColumns
				from MovieShowing S, Theater T 
				where S.ID = $showingID
				and S.TheaterID = T.ID";
				
		$seatingChart = mysql_query($seatQuery) or die(mysql_error());

		while($row = mysql_fetch_array($seatingChart))
		{
			$seatingChartArray = unserialize($row['SeatingChart']);
			$seatingRows = $row['SeatingRows'];
			$seatingColumns = $row['SeatingColumns'];
			
			//echo $seatingRows;
			//echo $seatingColumns;
			
			echo "<table border = \"1\" cellpadding = \"10\" align = \"left\">";
			
			$rowSelected = '';
			$columnSelected = '';
			
			$lengthX = count($seatingChartArray);
			
			for($x = 0; $x < $lengthX; $x++)
			{
				$lengthY = count($seatingChartArray[$x]);
				
				echo "<tr>";
				
				$rowSelected = $x;
				
				for($y = 0; $y < $lengthY; $y++)
				{
					$columnSelected = $y;
					echo "<td>";
					
					if($seatingChartArray[$x][$y] == '0')
					{
						echo "<form action = 'ReserveSeat.php' method = 'post'>";
						echo "<input type ='hidden' value = $showingID name ='showingID'>";
						echo "<input type ='hidden' value = $rowSelected name ='row'>";
						echo "<input type ='hidden' value = $columnSelected name ='column'>";
						echo "<input type ='hidexitden' name = 'memberInfo' class = 'memberInfoSelect'>";
						//echo "<input type ='hidden' value = '$memberID' name ='memberID'>";
						//echo "<input type ='hidden' value = '$memberName' name ='memberName'>";
						/*
						echo "<input type ='hidden' value = '";
						?>
						<script> 
							var e = document.getElementById("memberInfo").value;
							document.write(e); 
						</script>
						<?php 
						echo "' name = 'memberInfo'>";
						*/
						echo "<input type='submit' value= '" . $y . ", " . $x . "'>";
						
						echo "</form>";
					}
					
					else
					{
						echo "<input type='submit' value='Reserved' disabled>";
					}
					
					echo "</td>";
				}
				
				echo "</tr>";	
			}
			
			echo "</table>";
			
			
			echo '<br><br><a href ="index.php">Go to Index</a>';
		}
	}
	
	else
	{
		echo '<br>Got here illegally!';
		echo '<br><a href ="index.php">Go to Index</a>';
	}

?>

</body>
</html>
