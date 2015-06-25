<?php

if(!empty($_POST['email']) and !empty($_POST['password']))
{
	
	$useremail=	removeUnwanted($_POST['email']);
	$userpassword=	removeUnwanted($_POST['password']);

	if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) || strlen($useremail)>50)
	{
		$emailError = "Invalid email format";
		$userpassword="";
		include 'loginmenu.php';
		include "loginform.php";
		exit();			
	}

	if (strlen($userpassword)>20) {
		$passwordError = "Your password is too long. Please try again.";
		$userpassword="";
		include 'loginmenu.php';
		include "loginform.php";
		exit();	
	}

	$userpassword=	md5($userpassword);

	try
	{
		$sql = 'select * from users where email=:email and password=:password';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $useremail);
		$s->bindValue(':password', $userpassword);
		$s->execute();
	}
	catch (PDOException $e)
	{
		$error = 'Error getting logindata from the db : ' . $e->getMessage();
		include 'error.php';
		exit();
	}

	
	if ($row = $s->fetch())
	{

		$name=$row['username'];
		session_start();
		$_SESSION['name']=$name;
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
		//Admin page display
		if ($useremail=="robert@gmail.com")
		{
			include 'edittopics.php';
		}
		else
		{
			include 'listtopics.php';
		}
		include 'addtopic.php';
		include 'include/footer.php';
		exit();
	}
	else
	{
		$loginerror="Incorrect email or password. Please try again.";
		$userpassword="";
		include 'loginmenu.php';
		include "loginform.php";
		exit();
	}
}
else
{
	$loginerror="Please fill in all the fields.";
	$userpassword="";
	include 'loginmenu.php';
	include "loginform.php";
	exit();
}