<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo SITENAME ?></title>
	<link rel="stylesheet" href="<?php echo URLROOT?>/public/css/style.min.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href="">home</a></li>
			<li class='btn-login'>
				<?php if(isset($_SESSION['user_id'])) :?>
				<a href="<?php echo URLROOT?>/users/logout">log out</a>
				<?php else: ?>
				<a href="<?php echo URLROOT?>/users/login">login</a>
				<?php endif;?>
			</li>
		</ul>
	</nav>