<h3>Registration</h3>
	<form action="" method="post" id="registerform">
	<fieldset id="registerfieldset">
		<label>Name</label>
		<input type="text" name="username" id="regusername" maxlength="40" value="<?php echo $username?>">
		<br>
		<div id="regNameError" class="redtext"><?php echo "$regNameError";?></div>
		<br>
		<label>Email</label>
		<input type="email" name="email" id="regemail" maxlength="50" value="<?php echo $useremail?>">
		<br>
		<div id="regEmailError" class="redtext"><?php echo "$regEmailError";?></div>
		<br>
		<label>Password</label>
		<input type="password" name="password" id="regpassword" value="<?php echo $userpassword?>" >
		<br>
		<div id="regPasswordError" class="redtext"><?php echo "$regPasswordError";?></div>
		<br>
		<button type="submit" class="btn" name="registersubmit" id="btnregsubmit">Submit</button>
		<br>
		<br>
		<div id="registererror" class="redtext"><?php echo $registererror?></div>
	</fieldset>
	</form>
<?php include 'include/footer.php';?>