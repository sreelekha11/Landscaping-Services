<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost:3308';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'landscaping_services';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['application_id'], $_POST['client_id'], $_POST['mobile_no'], $_POST['email_id'], $_POST['block_id'], $_POST['route_id'], $_POST['address'])) {
	// Could not get the data that should have been sent.
	exit('Please fill all the details!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['application_id']) || empty($_POST['client_id']) || empty($_POST['mobile_no']) || empty($_POST['email_id'])|| empty($_POST['block_id']) || empty($_POST['route_id']) || empty($_POST['address']) ) {
	// One or more values are empty.
	exit('Please complete the Application form');
}

//email validation
if (!filter_var($_POST['email_id'], FILTER_VALIDATE_EMAIL)) {
	exit('Email ID is not valid!');
}
//invalid characters validation
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['client_id']) == 0) {
    exit('ID is not valid!');
}

//invalid characters validation
if (preg_match('/^[0-9]+$/', $_POST['mobile_no']) == 0 || strlen($_POST['mobile_no']) < 10) {
    exit('Mobile No is not valid!');
}


// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT application_id FROM application WHERE application_id = ? ')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['application_id']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Re-generate your Application ID and Re-submit!';
	} else {
		// Insert new account
		// Username doesnt exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO application (application_id, client_id,mobile_no, email_id, block_id, route_id, address) VALUES (?, ?, ?, ?, ?, ?, ?)')) {
	        $stmt->bind_param('ssissss', $_POST['application_id'], $_POST['client_id'], $_POST['mobile_no'], $_POST['email_id'], $_POST['block_id'], $_POST['route_id'], $_POST['address']);
	        $stmt->execute();
	        echo 'Application Successful!';
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all fields.
	echo 'Could not prepare statement!';
	
}
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all fields.
	echo 'Could not prepare statement!';
}
$con->close();
?>

