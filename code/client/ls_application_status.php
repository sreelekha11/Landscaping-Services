
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the employee is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ls_login.html');
	exit;
}
$DATABASE_HOST = 'localhost:3308';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'landscaping_services';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT application_id, status from assignedto where application_id in (select application_id from application where client_id = ? )');
// In this case we can use the empID to get the employee info.
$stmt->bind_param('s', $_SESSION['client_id']);
$stmt->execute();
$stmt->bind_result($application_id, $status);
$result = $stmt->get_result();
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>Your Applications</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
  
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', 
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
  
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
  
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
  
        td {
            font-weight: lighter;
        }
    </style>
</head>
  
<body>
    <section>
        <h1>Your Applications</h1>
        <!-- TABLE CONSTRUCTION-->
        <table>
            <tr>
                <th>Application ID</th>
				<th>Service Status</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
                while($rows= mysqli_fetch_array($result))
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
				<td><?php echo $rows['application_id'];?></td>
				<td><?php echo $rows['status'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
    </section>
</body>
  
</html>