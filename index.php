
<?php

$loginerror=$userpassword=$useremail=$posterror=$addmovieerror=$username=$registererror=$emailError=$passwordError="";
$regEmailError=$regNameError=$regPasswordError=$editposterror=$editTopicError="";
//Database connection
include_once 'include/dbconnection.php';

//Fetching movie names from the database
function fetchTopics()
{
	global $pdo;
	try
	{
		$sql = 'SELECT * FROM topic order by date desc';
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching topics: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	return $result;
}

//function to sanitise user's input	
function removeUnwanted($userinput)
{
   $userinput = trim($userinput);
   $userinput = stripslashes($userinput);
   $userinput = htmlspecialchars($userinput,ENT_QUOTES,'UTF-8');
   return $userinput;
}

//function to fetch reviews
function fetchReviews($movieid)
{
	global $pdo;
	try
	{
		$sql = 'SELECT posts.id,posts,posts.author,posts.date,topics FROM posts
		inner join topic
		on topicid=topic.id
		where posts.topicid=:id order by date desc';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $movieid);
		$s->execute();
	}		
	catch (PDOException $e)
	{
		$error = 'Error fetching posts: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	return $s;
}

//Inserting movie name into the database
if(isset($_POST['addmoviesubmit']))
{
	include 'insertingtopics.php';
}

//Inserting reviews into the database
if(isset($_POST['addpostsubmit']))
{
	include 'insertingposts.php';
}

//admin edit topics
if(isset($_POST['edittopic']))
{
	$movieid=$_POST['id'];
	$moviename=$_POST['moviename'];
	$author=$_POST['author'];
	$date=$_POST['date'];
	session_start();
	include 'opensessionmenu.php';
	include 'edittopiclayout.php';
	exit();		
}

if(isset($_POST['editedtopicsubmit']))
{
	include 'editedtopicsubmit.php';		
}

//admin delete topics
if(isset($_POST['deletetopic']))
{
	$movieid=$_POST['id'];
	$moviename=$_POST['moviename'];
	$author=$_POST['author'];
	$date=$_POST['date'];
	session_start();
	include 'opensessionmenu.php';
	include 'deletetopic.php';
}

//Fetching the reviews for the corresponding movie
if(isset($_POST['moviename']))
{
	$movieid=$_POST['id'];
	include "fetchingposts.php";	
}

//Displaying login form
if(isset($_POST['login']))
{
	include 'loginmenu.php';
	include "loginform.php";
	exit();
}

//Login verification
if(isset($_POST['loginsubmit']))
{
	include "loginverification.php";
}

//admin edit post
if(isset($_POST['editpost']))
{
	$postid=$_POST['id'];
	try
	{
		$sql = 'SELECT posts,posts.author,posts.date,topicid,topics FROM posts
		inner join topic
		on topicid=topic.id
		where posts.id=:id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $postid);
		$s->execute();
	}		
	catch (PDOException $e)
	{
		$error = 'Error fetching posts: ' . $e->getMessage();
		include 'error.php';
		exit();
	}
	foreach ($s as $row)
	{
		$posttext = $row['posts'];	
		$author = $row['author'];	
		$date = $row['date'];
		$moviename=$row['topics'];
		$movieid=$row['topicid'];
	}
	include 'editpostlayout.php';
	exit();
}

//admin edit post submit
if(isset($_POST['editedpostsubmit']))
{
	include 'editedpostsubmit.php';		
}

//admin delete post
if(isset($_POST['deletepost']))
{
	include 'deletepost.php';
}

//When log out button is clicked
if(isset($_POST['logout']))
{
	include 'logoutpage.php';		
}

//Displaying Registration Form
if(isset($_POST['register']))
{
	include 'loginmenu.php';
	include "registrationform.php";
	exit();
}

//Registering a new user
if (isset($_POST['registersubmit']))
{
	include 'registration.php';
}

//Displaying separate home page for logged in members and basic home page for all other users.	
if(isset($_POST['home']))
{
	session_start();
	if (isset($_SESSION['loggedIn'])) {
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
		include_once 'opensessionmenu.php';
		//admin page display
		if ($_SESSION['name']== "Robert")
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
}

//Displaying the basic home page with movie names
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
include 'loginmenu.php';
include 'listtopics.php';
include 'include/footer.php';


