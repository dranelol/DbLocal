<?php
//phpinfo();
// Display errors to browser
error_reporting(E_ALL ^ E_DEPRECATED);

ini_set("display_errors", 1);
// --------------------------
$host="";
$user="groupH";
$password="MaximumJank";
$database="cs4601_groupH";

// Connect to the database
$connect = mysql_connect($host,$user,$password)
	 or die("Unable to connect to database");
// Select the database - the @ supresses MySQL error output
@mysql_select_db($database) or die("Unable to select database");
session_start();

?>
