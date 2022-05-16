<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ls_login.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Client Home Page</title>
		<link href="stylehome.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Landscaping Services</h1>
				<a href="ls_application_status.php"><i class="fas fa-list-alt"></i>Your Applications</a>
				<a href="ls_IDGenerate.php"><i class="fas fa-edit"></i>New Application</a>
				<a href="ls_logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Client Home Page</h2>
			<p>Welcome back, <?=$_SESSION['client_id']?>!</p>
		</div>
	</body>
</html>