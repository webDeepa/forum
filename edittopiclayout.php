<h2>Movie</h2>

<form action="" method="post" id="edittopicform" >
	<blockquote>
		<p>
			<input type="text"  name="moviename" id="editedtopic" value="<?php echo htmlspecialchars($moviename, ENT_QUOTES,'UTF-8'); ?>"><br><br>
			<input type="hidden" name="id" value="<?php echo $movieid; ?>">
			<label>Started by : </label><?php echo htmlspecialchars($author, ENT_QUOTES,'UTF-8') ;?><br><br>
			<label>Date : </label><?php echo htmlspecialchars($date, ENT_QUOTES,'UTF-8');?>

			<br><br>
			<button type="submit" name="editedtopicsubmit" class="btn" id="btnedittopicsubmit" >Submit</button>
			<div id="editTopicError" class="redtext"><?php echo $editTopicError ;?></div>
		</p>
	</blockquote>
</form>
<?php include 'include/footer.php';