<?php

$topicname=removeUnwanted($_POST['addmovie']);
if(!empty($_POST['addmovie']))
{			
	session_start();
	try
	{
		$sql = 'INSERT INTO topic SET
		topics = :topicname,
		author = :author,
		date = CURDATE()';
		$s = $pdo->prepare($sql);
		$s->bindValue(':topicname', $topicname);
		$s->bindValue(':author',$_SESSION['name']);
		$s->execute();
	}		
	catch (PDOException $e)
	{
		$error = 'Error inserting movie name to the database : ' . $e->getMessage();
		include 'error.php';
		exit();
	}
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
	include 'opensessionmenu.php';
	if ($_SESSION['name']== "Robert") {
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
	$addmovieerror="Please type a movie name.";
	session_start();
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
	include 'opensessionmenu.php';
	if ($_SESSION['name']== "Robert") {
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