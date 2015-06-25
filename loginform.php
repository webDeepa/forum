<h3>Log In</h3>
	<form action="" method="post" id="loginform">
	<fieldset id="loginfieldset">
		<label>Email</label>
		<input type="email" name="email" id="email" maxlength="50" value="<?php echo $useremail?>">
		<br>
		<div id="emailError" class="redtext"><?php echo "$emailError";?></div>
		<br>
		<label>Password</label>
		<input type="password" name="password" id="password" value="<?php echo $userpassword?>" ><br>
		<div id="passwordError" class="redtext"><?php echo "$passwordError";?></div>
		<br>
		<button type="submit" class="btn" name="loginsubmit" id="btnloginsubmit">Submit</button>
		<br><br>

		<div id="loginerror" class="redtext"><?php echo $loginerror?></div>
	</fieldset>
	</form>
<?php include 'include/footer.php';?>