<?php foreach ($posts as $post): ?>

<form action="" method="post">
	<blockquote>
		<p>
			<fieldset id="postfieldset">
				<?php echo htmlspecialchars($post['posts'], ENT_QUOTES,'UTF-8'); ?>
				<input type="hidden" name="id" value="<?php echo $post['id']; ?>">
				<input type="hidden" name="movieid" value="<?php echo $movieid; ?>">
				<br><br>
				- <span class="smallfont"> by </span>
					<?php
						echo '<span class="mediumfont postauthor">'.htmlspecialchars($post['author'], ENT_QUOTES,'UTF-8').'</span>'.'<span class="smallfont"> on </span>'; 
						echo htmlspecialchars($post['date'], ENT_QUOTES,'UTF-8'); 
					?>
				<button type="submit" name="editpost" class="btnedit" >Edit</button>
				<button type="submit" name="deletepost" class="btndelete">Delete</button>
			</fieldset>
		</p>
	</blockquote>
</form>
<?php endforeach; 