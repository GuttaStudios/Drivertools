<?php

//DriverTools app 4/17/2015 by Melvin A. Hunter

DEFINE ('db_user', 'root');
DEFINE ('db_pass', '');
DEFINE ('db_host', 'drivertools-guttastudios.rhcloud.com');
DEFINE ('db_name', 'drivertools');

// Using MySQL API (connecting from APp Engine)
$dbc = mysql_connect('db_host', 'db_user', 'db_pass');
if(!$dbc)
{
	die("Database connection failed: " .mysql_error($dbc));
	exit();
}

//Database Selection
$dbs = mysql_select_db($dbc, db_name);
{
	die("Database connection failed: " .mysql_error($dbc));
	exit();
}

//Login info to get from database "Users Table"
$userID = mysql_real_escape_string($dbc, $_GET['user_id']);
$userName = mysql_real_escape_string($dbc, $_GET['username']);
$passWord = mysql_real_escape_string($dbc, $_GET['password']);
$firstName = mysql_real_escape_string($dbc, $_GET['first_name']);
$lastName = mysql_real_escape_string($dbc, $_GET['last_name']);
$emailAddress = mysql_real_escape_string($dbc, $_GET['email_address']);
$companyName = mysql_real_escape_string($dbc, $_GET['company_name']);

$query = "INSERT INTO users (user_id, username, password, first_name, last_name, email_address, company_name)
		  VALUES ('$userID', '$userName', '$passWord', '$firstName', '$lastName', '$emailAddress', '$companyName')";

$result = mysql_query($dbc, $query) or trigger_error("Query MySQL Error: " .mysql_error($dbc));

mysql_close($dbc)

?>

