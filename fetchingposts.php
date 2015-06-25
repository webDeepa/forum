		
<?php


session_start();
if (isset($_SESSION['loggedIn'])) {
	$_SESSION['movieid']=$movieid; 
}

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

//if reviews are available for the given movie
if(!empty($posts))
{
	foreach ($posts as $post)
	{
		$moviename=$post['topics'];
	}
	//Check if user is logged in or not and display the corresponding menu and additional provisions
	
	if (isset($_SESSION['loggedIn'])) {
		include_once 'opensessionmenu.php';
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
		include 'loginmenu.php';
		echo '<h2>Movie Reviews</h2>';
		echo '<h3>'.htmlspecialchars($moviename, ENT_QUOTES,'UTF-8').'</h3>';
		include 'listposts.php';
		include 'include/footer.php';
		exit();	
	}
}
//if no reviews are available then do this		
else
{
	try
	{
		$sql = 'SELECT topics FROM topic
		where id =:id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $movieid);
		$s->execute();
	}		
	catch (PDOException $e)
	{
		$error = 'Error fetching movie name : ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	foreach ($s as $row)
	{
		$moviename=$row['topics'];
	}
	
	if (isset($_SESSION['loggedIn'])) 
	{
		include_once 'opensessionmenu.php';
		echo '<h2>Movie Reviews</h2>';
		echo '<h3>'.htmlspecialchars($moviename, ENT_QUOTES,'UTF-8').'</h3>';
		include 'addpost.php';
		include 'include/footer.php';
		exit();
	}
	else
	{
		include 'loginmenu.php';
		echo '<h2>Movie Reviews</h2>';
		echo '<h3>'.htmlspecialchars($moviename, ENT_QUOTES,'UTF-8').'</h3>';
		echo '<blockquote><p><b>Currently, no reviews are available for this movie. You can log in and post a review. Thanks.</b></p></blockquote>';
		include 'include/footer.php';
		exit();

	}
}