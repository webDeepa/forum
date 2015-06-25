<?php

$postid=$_POST['id'];
$movieid=$_POST['movieid'];
try
{
	$sql = 'DELETE FROM posts 
	where id=:id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $postid);
	$s->execute();

}
catch (PDOException $e)
{
	$error = 'Error deleting posts: ' . $e->getMessage();
	include 'error.php';
	exit();
}
include 'fetchingposts.php';