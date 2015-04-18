<?php

//DriverTools app 4/17/2015 by Melvin A. Hunter

DEFINE ('db_user', 'drivertools');
DEFINE ('db_pass', 'lj5iix4542');
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

//get database info "logbook"
$fareID = mysql_real_escape_string($dbc, $_GET['fare_id']);
$userID = mysql_real_escape_string($dbc, $_GET['user_id']);
$fareDate = mysql_real_escape_string($dbc, $_GET['fare_date']);
$fareTime = mysql_real_escape_string($dbc, $_GET['fare_time']);
$dispatchNumber = mysql_real_escape_string($dbc, $_GET['dispatch_num']);
$fareWages = mysql_real_escape_string($dbc, $_GET['fare_wages']);
$fareDeductions = mysql_real_escape_string($dbc, $_GET['fare_deductions']);
$netPay = mysql_real_escape_string($dbc, $_GET['net_pay']);
$destination = mysql_real_escape_string($dbc, $_GET['destination']);

//Update logbook
$query = "UPDATE logbook SET fare_date='$fareDate', dispatch_num='$dispatchNumber', fare_wages='$fareWages', fare_deductions='$fareDeductions', net_pay='$netPay', destination='$destination' WHERE fare_id='$fareID', user_id='$userID'";

$result = mysql_query($dbc, $query) or trigger_error("Query MySQL Error: " .mysql_error($dbc));

mysql_close($dbc);

?>