<?php

$movieid=$_POST['id'];
$editedmoviename=$_POST['moviename'];
try
{
	$sql = 'UPDATE topic set
	topics=:editedtopic
	where id=:id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $movieid);
	$s->bindValue(':editedtopic',$editedmoviename);
	$s->execute();

}
catch (PDOException $e)
{
	$error = 'Error inserting edited topics : ' . $e->getMessage();
	include 'error.php';
	exit();
}
session_start();
include 'opensessionmenu.php';
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