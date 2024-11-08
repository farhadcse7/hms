<?php
// ini_set('error_reporting', E_ALL);
date_default_timezone_set('Asia/Dhaka');
$dbhost = 'localhost';
$dbname = 'hms';
$dbuser = 'root';
$dbpass = '';
try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}

define('SITE_URL', 'http://localhost/hms/');