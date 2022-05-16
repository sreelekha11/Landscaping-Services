<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost:3308';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'landscaping_services';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['stakeholder_id'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the ID and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT stakeholder_id, password FROM stakeholders WHERE stakeholder_id = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['stakeholder_id']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	if ($stmt->num_rows > 0) {
	$stmt->bind_result($stakeholder_id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($_POST['password'] === $password) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['stakeholder_id'] = $_POST['stakeholder_id'];
		$_SESSION['stakeholder_id'] = $stakeholder_id;
		header('Location: ls_sh_home.php');
	} else {
		// Incorrect password
		echo 'Incorrect ID and/or password!';
		
	}
} else {
	// Incorrect username
	echo 'Incorrect ID and/or password!';
}


	$stmt->close();
}
?>