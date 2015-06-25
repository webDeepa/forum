<?php

$postreview=removeUnwanted($_POST['addpost']);
if(!empty($_POST['addpost']))
{			
	session_start();
	try
	{
		$sql = 'INSERT INTO posts SET
		posts = :postreview,
		author = :author,
		date = CURDATE(),
		topicid = :movieid';
		$s = $pdo->prepare($sql);
		$s->bindValue(':postreview', $postreview);
		$s->bindValue(':author',$_SESSION['name']);
		$s->bindValue(':movieid',$_SESSION['movieid']);
		$s->execute();
	}		
	catch (PDOException $e)
	{
		$error = 'Error inserting movie name to the database : ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	$movieid=$_SESSION['movieid'];
	$s=fetchReviews($movieid);
	foreach ($s as $row)
	{
		$posts[] = array(
		'id' => $row['id'],
		'posts' => $row['posts'],
		'author' => $row['author'],
		'date' => $row['date'],
		'topics'=> $row['topics']
		);
	}
	foreach ($posts as $post)
	{
		$moviename=$post['topics'];
	}
	include 'opensessionmenu.php';
	echo '<h2>Movie Reviews</h2>';
	echo '<h3>'.htmlspecialchars($moviename, ENT_QUOTES,'UTF-8').'</h3>';
	if ($_SESSION['name']== "Robert") {
		include 'editposts.php';
	}
	else
	{
		include 'listposts.php';
	}		
	include 'addpost.php';
	include 'include/footer.php';
	exit();
}
else
{
	$posterror="Please write a review.";
	session_start();
	$movieid=$_SESSION['movieid'];
	include "fetchingposts.php";
}