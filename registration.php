<?php

if(!empty($_POST['email']) and !empty($_POST['password'] and !empty($_POST['username'])))
{
	$username=	removeUnwanted($_POST['username']);
	$useremail=	removeUnwanted($_POST['email']);
	$userpassword=	removeUnwanted($_POST['password']);

	if (strlen($username)>40) {
		$regNameError = "Your name is too long. Please try again with a short name.";
		$userpassword=$username="";
		include 'loginmenu.php';
		include "registrationform.php";
		exit();	
	}

	if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) || strlen($useremail)>50)
	{
		$regEmailError = "Invalid email format";
		$userpassword="";
		include 'loginmenu.php';
		include "registrationform.php";
		exit();			
	}

	if (strlen($userpassword)>20) {
		$regPasswordError = "Your password is too long. Please try again.";
		$userpassword="";
		include 'loginmenu.php';
		include "registrationform.php";
		exit();	
	}

	$userpassword=	md5($userpassword);

	try
	{
		$sql = 'select * from users where email=:email';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $useremail);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error getting data from the db to check for registeration: ' . $e->getMessage();
		include 'error.php';
		exit();
	}

	if ($row = $s->fetch())
	{
		include 'loginmenu.php';
		$registererror="This email already exists. Please enter a different email address.";
		$useremail="";
		$userpassword="";
		include "registrationform.php";
		exit();
	}

	try
	{
		$sql2 = 'INSERT INTO users set username=:name ,email=:email ,password=:password';
		$s2 = $pdo->prepare($sql2);
		$s2->bindValue(':name', $username);
		$s2->bindValue(':email', $useremail);
		$s2->bindValue(':password', $userpassword);
		$s2->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error inserting data to the db for registering : ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	session_start();
	$_SESSION['name']=$username;
	$_SESSION['password'] = $userpassword;
	$_SESSION['loggedIn'] = TRUE;
	include 'opensessionmenu.php';
	$result= fetchTopics();
	foreach ($result as $row)
	{
		$topics[] = array(
		'id' => $row['id'],
		'topics' => $row['topics'],
		'author' => $row['author'],
		'date' => $row['date']
		);
	}
	include 'listtopics.php';
	include 'addtopic.php';
	include 'include/footer.php';
	exit();
}
else
{
	$username=	removeUnwanted($_POST['username']);
	$useremail=	removeUnwanted($_POST['email']);
	include 'loginmenu.php';
	$registererror="Please fill in all the fields.";
	include "registrationform.php";
	exit();
}