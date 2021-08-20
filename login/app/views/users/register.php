<?php
 get_template_part('header');

 ?>
<div class="hero">
	<div>
		<h2><?php echo $data['title'];?></h2>
	<form action="<?php echo URLROOT?>/users/register" method="post">
	<div>
		<label for="username">username</label>
		<input type="text" name="username" id="username">
		<span class="invalidFeedback"><?php echo $data['usernameError']?></span>
	</div>
	<div>
		<label for="email">email</label>
		<input type="email" name="email" id="email">
		<span class="invalidFeedback"><?php echo $data['emailError']?></span>
	</div>
	<div>
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
		<span class="invalidFeedback"><?php echo $data['passwordError']?></span>
		<div class="passwordHelp">
			<ul>
				<li class="length">Passwords must contain between 8 and 2 characters.</li>
				<li class="capital">Passwords must contain at least 1 capital letter.</li>
				<li class="number">Passwords must contain at least 1 number</li>
				<li class="special">Passwords must contain at least 1 special character</li>
			</ul>
		</div>
	</div>
	<div>
		<label for="confirmPassword">Confirm Password</label>
		<input type="password" name="confirmPassword" id="confirmnPassword">
		<span class="invalidFeedback"><?php echo $data['confirmPasswordError']?></span>
	</div>
	<div>
		<input type="submit" value="Submit">
	</div>
	<p>Already registered? <a href="<?php echo URLROOT?>/users/login">login</a></p>

	</form>
	</div>
	
</div>
 
<?php
 get_template_part('footer');