<?php 

session_start();
session_unset();
session_destroy();	
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
echo '<span class="greentext"><b>You have been successfully logged out.</b></span>';
include 'listtopics.php';
include 'include/footer.php';
exit();