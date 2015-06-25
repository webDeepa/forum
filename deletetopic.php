<?php

//deleting all post related to it first 
try
{
	$sql = 'DELETE FROM posts 
	where topicid=:id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $movieid);
	$s->execute();

}
catch (PDOException $e)
{
	$error = 'Error deleting posts for the selected movie : ' . $e->getMessage();
	include 'error.php';
	exit();
}

//now deleting the movie
try
{
	$sql = 'DELETE FROM topic
	where id=:id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $movieid);
	$s->execute();

}
catch (PDOException $e)
{
	$error = 'Error deleting the selected movie : ' . $e->getMessage();
	include 'error.php';
	exit();
}
//fetching topics
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
include 'edittopics.php';
include 'addtopic.php';
include 'include/footer.php';
exit();