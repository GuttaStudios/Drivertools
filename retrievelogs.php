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


$result = mysql_query($dbc, "SHOW COLUMNS FROM logbook");

$numberOfRows = mysql_num_rows($result);

if($numberOfRows > 0)
{
	$values = mysql_query($dbc, "SELECT * FROM logbook WHERE user_id='sam'");
	while($rowr = mysql_fetch_row($values))
	{
		for($i=0; $i<$numberOfRows; $i++)
		{
			$csv_output .=$rowr[$i]. ", ";
		}
		
		$csv_output .= "\n";
	}
}

print $csv_output;
exit;

?>