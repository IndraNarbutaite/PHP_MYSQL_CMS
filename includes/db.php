<?php 

	$db['db_host'] 		= 	"localhost:3307";
	$db['db_user'] 		= 	"root";
	$db['db_password']  = 	"mysql";
	$db['db_name'] 		= 	"test_db";

	foreach ($db as $key => $value) {
		define(strtoupper($key), $value);
	}

	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if (!$connection) {
		die("Connection cannot be established" . mysqli_error($connection));
	} 
	// else {
	// 	echo "Connection established";
	// }

?>