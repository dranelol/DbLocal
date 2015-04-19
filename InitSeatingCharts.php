<?php 
	include "login.php";
	
	$seatingQuery = "select S.ID, S.SeatingChart, T.ID, T.SeatingRows, T.SeatingColumns
			from MovieShowing S, Theater T
			where S.TheaterID = T.ID";
	$seatingResult = mysql_query($seatingQuery) or die(mysql_error());
	while($row = mysql_fetch_array($seatingResult))
	{
		$seatingRows = array();
		for($x = 0; $x < $row['SeatingColumns'];$x++)
		{
			$seatingRows[$x] = array();
			for($y = 0; $y < $row['SeatingRows'];$y++)
			{
				$seatingRows[$x][$y] = '0';
			}
		}
		//$seatingRows[2][3] = '1';
		$seatingChartSerialized = serialize($seatingRows);

		$updateQuery = "update MovieShowing 
				set SeatingChart = '$seatingChartSerialized'
				where ID = '$row[0]'";
		echo "<br>Showing ID:";
		echo $row[0];
		echo "<br>Theater ID:";
		echo $row['ID'];
		$updateSeatingResult = mysql_query($updateQuery) or die(mysql_error());
		
	}

	$newQuery = "select * from MovieShowing where ID = 1";
	$newResult = mysql_query($newQuery) or die(mysql_error());
	while($row = mysql_fetch_array($newResult))
	{
		$dumb = unserialize($row['SeatingChart']);
		echo "<br><br>";
		echo $dumb[2][3];
	}
?>
