<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ls_sh_login.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Landscaping Services Database</title>
		<link href="ls_sh_stylehome.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<div class="content">
			<h2>Landscaping Services Database</h2>
			<p>Welcome back, <?=$_SESSION['stakeholder_id']?>!</p>
		</div>
		<nav class="breadcrumbs">
			<div>
				<a href="ls_sh_application.php"><i class="fas fa-tasks"></i>Applications</a>
			</div>
			<div>
			    <a href="ls_sh_client.php"><i class="fas fa-user-circle"></i>Clients</a>
			</div>
			<div>
			    <a href="ls_sh_employee.php"><i class="fas fa-user-circle"></i>Employees</a>
			</div>
			<div>
			    <a href="ls_sh_assignedto.php"><i class="fas fa-tasks"></i>Gardener Assignments</a>
			</div>
			<div>
			    <a href="ls_sh_equipment.php"><i class="fas fa-tools"></i>Equipment</a>
			</div>
			<div>
			    <a href="ls_sh_roster.php"><i class="fas fa-clock"></i>Daily Duty Roster</a>
			</div>
			<div>
			    <a href="ls_sh_payment.php"><i class="fas fa-money-check"></i>Payments</a>
			</div>
			<div>
			    <a href="ls_sh_logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
	</body>
</html>