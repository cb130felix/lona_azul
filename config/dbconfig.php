<?php

require_once 'settings.php';

function createConn(){
	
	global $settings;
	
	$servername = $settings['db_servername'];
	$username = $settings['db_username'];
	$password = $settings['db_password'];
	$dbname = $settings['db_dbname'];

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
		return null;
	}else{
		return $conn;
		
	}
	
	
}

function closeConn($conn){

	mysqli_close($conn);
	return true;
}