<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

DEFINE ('db_user', 'drivertools');
DEFINE ('db_pass', 'lj5iix4542');
DEFINE ('db_host', 'drivertools-guttastudios.rhcloud.com');
DEFINE ('db_name', 'drivertools');

$admin = UserService::getCurrentUser();

if (!$admin) {
  header('Location: ' . UserService::createLoginURL($_SERVER['REQUEST_URI']));
}
?>

<html>
 <body>
  <h2>DriverTools Admin Page</h2>
  <?php
  echo 'Welcome, ' . htmlspecialchars($admin->getNickname());
  
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
  	$values = mysql_query($dbc, "SELECT * FROM users");
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