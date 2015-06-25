<?php
try
{
	$pdo = new PDO('mysql:host=localhost;dbname=elegantd_forum', 'elegantd_foruser',
	'mypassword');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'Unable to connect to the database server:'.$e->getMessage();
	include 'error.php';
	exit();
}