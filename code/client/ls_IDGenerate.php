<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Your Application ID</title>
		<link href="ls_stylehome.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Landscaping Services</h1>
				<a href="/ls_application.html"><i class="fas fa-user-circle"></i>Fill the Application</a>
			</div>
		</nav>
		<div class="content">
			<h2>Your Application ID</h2>
			<p>Your Application ID is:  <?php echo md5(uniqid(rand(), true));?></p>
			<p>Kindly note this ID and mention it in the application form.</p>
			<p>To fill the application form, click on "Fill the Application" button at the right-top of this page.</p>
		</div>
	</body>
</html>