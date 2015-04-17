<?php

//DriverTools app 4/17/2015 by Melvin A. Hunter

DEFINE ('db_user', 'root');
DEFINE ('db_pass', '');
DEFINE ('db_host', ':/cloudsql/db-drivertools-0002:sql-db-0001');
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


$result = mysql_query($dbc, "SHOW COLUMNS FROM users");

$numberOfRows = mysql_num_rows($result);

if($numberOfRows > 0)
{
	$values = mysql_query($dbc, "SELECT * FROM users LIMIT 1, 2 WHERE user_id='sam'");
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