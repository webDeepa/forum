<?php

$postid=$_POST['id'];
$editedpost=removeUnwanted($_POST['editedpost']);
$movieid=$_POST['movieid'];

try
{
	$sql = 'UPDATE posts set
	posts=:editedpost
	where id=:id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':id', $postid);
	$s->bindValue(':editedpost', $editedpost);
	$s->execute();

}
catch (PDOException $e)
{
	$error = 'Error inserting edited posts: ' . $e->getMessage();
	include 'error.php';
	exit();
}
include 'fetchingposts.php';