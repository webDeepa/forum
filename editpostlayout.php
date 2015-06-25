<?php
session_start();
include 'opensessionmenu.php';?>
<h3><?php echo $moviename?></h3>
	<blockquote>
		<p>
			<form action="" method="post" id="editpostform">
				
					<textarea type="text" name="editedpost" id="editedpost"><?php echo htmlspecialchars($posttext, ENT_QUOTES,'UTF-8') ;?></textarea><br><br>
					<input type="hidden" name="id" value="<?php echo $postid; ?>">
					<input type="hidden" name="movieid" value="<?php echo $movieid; ?>">
					<label>Written by : </label><?php echo htmlspecialchars($author, ENT_QUOTES,'UTF-8') ;?><br><br>
					<label>Date : </label><?php echo htmlspecialchars($date, ENT_QUOTES,'UTF-8');?>
					
				<br><br>
				<button type="submit" class="btn" name="editedpostsubmit" id="btneditpostsubmit" >Submit</button>
				<div id="editposterror" class="redtext"><?php echo $editposterror ;?></div>
			</form>
		</p>
	</blockquote>
<?php include 'include/footer.php';