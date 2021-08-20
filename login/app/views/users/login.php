<?php
 get_template_part('header');

 ?>
<div class="hero">
	<div>
		<h2><?php echo $data['title'];?></h2>
	<form action="<?php echo URLROOT?>/users/login" method="post">
	<div>
		<label for="username">username</label>
		<input type="text" name="username" id="username">
		<span class="invalidFeedback"><?php echo $data['usernameError']?></span>
	</div>
	<div>
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
		<span class="invalidFeedback"><?php echo $data['passwordError']?></span>
	</div>
	<div>
		<input type="submit" value="Submit">
	</div>
	<p>Not registered yet? <a href="<?php echo URLROOT?>/users/register">Create an account</a></p>

	</form>
	</div>

</div>
 
<?php
 get_template_part('footer');