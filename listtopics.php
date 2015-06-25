<h2>Movies</h2>
<?php foreach ($topics as $topic): ?>

<form action="" method="post" >
	<blockquote>
		<p>
			<input type="submit" class="colortext" name="moviename" value="<?php echo htmlspecialchars($topic['topics'], ENT_QUOTES,'UTF-8'); ?>">
			<input type="hidden" name="id" value="<?php echo $topic['id']; ?>">
			- <span class="smallfont">started by </span>
				<?php
					echo '<span class="mediumfont">'.htmlspecialchars($topic['author'], ENT_QUOTES,'UTF-8').'</span>'.'<span class="smallfont"> on </span>'; 
					echo '<span class="mediumfont">'.htmlspecialchars($topic['date'], ENT_QUOTES,'UTF-8').'</span>'; 
				?>
		</p>
	</blockquote>
</form>

<?php endforeach;



