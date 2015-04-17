<?php
use google\appengine\api\users\User;
use google\appengine\api\users\UserService;

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
  
  // Using PDO_MySQL (connecting from App Engine)
  $dbc = new pdo('mysql:unix_socket=/cloudsql/db-drivertools-0002:sql-db-0001;dbname=drivertools', 'root', '1234');
  if(!$dbc)
  {
  	die("MySQL connection failed: " .mysql_error($dbc));
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